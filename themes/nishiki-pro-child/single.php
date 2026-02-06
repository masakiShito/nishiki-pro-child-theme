<?php
/**
 * 記事詳細ページ - モダンデザイン
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<div class="single-wrapper">
    <?php while (have_posts()) : the_post(); ?>

    <article <?php post_class('single-article'); ?>>
        <!-- アイキャッチ画像 - フルワイド -->
        <?php if (has_post_thumbnail()) : ?>
            <div class="article-hero">
                <?php the_post_thumbnail('full', ['class' => 'article-hero__image']); ?>
                <div class="article-hero__overlay">
                    <div class="article-hero__content">
                        <?php
                        $categories = get_the_category();
                        if (!empty($categories)) :
                            $category = $categories[0];
                        ?>
                            <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="article-category">
                                <?php echo esc_html($category->name); ?>
                            </a>
                        <?php endif; ?>
                        
                        <h1 class="article-title"><?php the_title(); ?></h1>
                        
                        <time class="article-date" datetime="<?php echo get_the_date('c'); ?>">
                            <?php echo get_the_date('Y年n月j日'); ?>
                        </time>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <!-- ヘッダー（画像なしの場合） -->
            <header class="article-header article-header--no-image">
                <?php
                $categories = get_the_category();
                if (!empty($categories)) :
                    $category = $categories[0];
                ?>
                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="article-category">
                        <?php echo esc_html($category->name); ?>
                    </a>
                <?php endif; ?>
                
                <h1 class="article-title"><?php the_title(); ?></h1>
                
                <time class="article-date" datetime="<?php echo get_the_date('c'); ?>">
                    <?php echo get_the_date('Y年n月j日'); ?>
                </time>
            </header>
        <?php endif; ?>

        <!-- 記事本文エリア -->
        <div class="article-main">
            <div class="article-main__container">
                <!-- メインコンテンツ（左側） -->
                <div class="article-body">
                    <div class="article-content">
                        <?php the_content(); ?>
                    </div>
                </div>

                <!-- サイドバー（右側） -->
                <aside class="article-sidebar">
                    <!-- 目次 -->
                    <div class="sidebar-widget sidebar-toc">
                        <div class="sidebar-widget__header">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="8" y1="6" x2="21" y2="6"/>
                                <line x1="8" y1="12" x2="21" y2="12"/>
                                <line x1="8" y1="18" x2="21" y2="18"/>
                                <line x1="3" y1="6" x2="3.01" y2="6"/>
                                <line x1="3" y1="12" x2="3.01" y2="12"/>
                                <line x1="3" y1="18" x2="3.01" y2="18"/>
                            </svg>
                            <span class="sidebar-widget__title">目次</span>
                        </div>
                        <nav class="sidebar-widget__content" aria-label="目次">
                            <ol class="article-toc__list" id="toc"></ol>
                        </nav>
                    </div>

                    <!-- カテゴリー -->
                    <?php
                    $post_categories = get_the_category();
                    if (!empty($post_categories)) :
                    ?>
                        <div class="sidebar-widget sidebar-categories">
                            <div class="sidebar-widget__header">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>
                                </svg>
                                <span class="sidebar-widget__title">カテゴリー</span>
                            </div>
                            <div class="sidebar-widget__content">
                                <ul class="sidebar-categories__list">
                                    <?php foreach ($post_categories as $cat) : ?>
                                        <li class="sidebar-categories__item">
                                            <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="sidebar-categories__link">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M9 18l6-6-6-6"/>
                                                </svg>
                                                <?php echo esc_html($cat->name); ?>
                                                <span class="sidebar-categories__count">(<?php echo $cat->count; ?>)</span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- タグ -->
                    <?php
                    $post_tags = get_the_tags();
                    if ($post_tags) :
                    ?>
                        <div class="sidebar-widget sidebar-tags">
                            <div class="sidebar-widget__header">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/>
                                    <line x1="7" y1="7" x2="7.01" y2="7"/>
                                </svg>
                                <span class="sidebar-widget__title">タグ</span>
                            </div>
                            <div class="sidebar-widget__content">
                                <div class="sidebar-tags__list">
                                    <?php foreach ($post_tags as $tag) : ?>
                                        <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="sidebar-tags__item">
                                            #<?php echo esc_html($tag->name); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </aside>
            </div>
        </div>

        <!-- 記事フッター -->
        <footer class="article-footer">
            <div class="article-footer__container">
                <!-- シェアボタン -->
                <div class="article-share">
                    <span class="article-share__label">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="18" cy="5" r="3"/>
                            <circle cx="6" cy="12" r="3"/>
                            <circle cx="18" cy="19" r="3"/>
                            <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/>
                            <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/>
                        </svg>
                        シェアする
                    </span>
                    <div class="article-share__buttons">
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>"
                           class="article-share__button article-share__button--twitter"
                           target="_blank"
                           rel="noopener noreferrer"
                           aria-label="Twitterでシェア">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>"
                           class="article-share__button article-share__button--facebook"
                           target="_blank"
                           rel="noopener noreferrer"
                           aria-label="Facebookでシェア">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <button type="button"
                                class="article-share__button article-share__button--copy"
                                data-url="<?php echo esc_url(get_permalink()); ?>"
                                aria-label="URLをコピー">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="9" y="9" width="13" height="13" rx="2" ry="2"/>
                                <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </footer>
    </article>

    <!-- 関連記事 -->
    <?php
    $categories = get_the_category();
    if (!empty($categories)) :
        $related_posts = new WP_Query(array(
            'category__in' => array($categories[0]->term_id),
            'post__not_in' => array(get_the_ID()),
            'posts_per_page' => 3,
            'orderby' => 'rand',
        ));

        if ($related_posts->have_posts()) :
    ?>
        <section class="related-posts">
            <div class="related-posts__container">
                <h2 class="related-posts__title">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                    </svg>
                    関連記事
                </h2>
                <div class="related-posts__grid">
                    <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                        <article class="related-card">
                            <a href="<?php the_permalink(); ?>" class="related-card__link">
                                <div class="related-card__image">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('medium', ['class' => 'related-card__img']); ?>
                                    <?php else : ?>
                                        <div class="related-card__placeholder">
                                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                                <polyline points="21 15 16 10 5 21"/>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="related-card__content">
                                    <?php
                                    $rel_categories = get_the_category();
                                    if (!empty($rel_categories)) :
                                    ?>
                                        <span class="related-card__category"><?php echo esc_html($rel_categories[0]->name); ?></span>
                                    <?php endif; ?>
                                    <h3 class="related-card__title"><?php the_title(); ?></h3>
                                    <time class="related-card__date" datetime="<?php echo get_the_date('c'); ?>">
                                        <?php echo get_the_date('Y.m.d'); ?>
                                    </time>
                                </div>
                            </a>
                        </article>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    <?php
        endif;
        wp_reset_postdata();
    endif;
    ?>

    <!-- 前後の記事ナビゲーション -->
    <nav class="post-navigation">
        <div class="post-navigation__container">
            <?php
            $prev_post = get_previous_post();
            $next_post = get_next_post();
            ?>

            <?php if ($prev_post) : ?>
                <div class="post-navigation__item post-navigation__item--prev">
                    <a href="<?php echo get_permalink($prev_post); ?>" class="post-navigation__link">
                        <span class="post-navigation__label">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M19 12H5M12 19l-7-7 7-7"/>
                            </svg>
                            前の記事
                        </span>
                        <span class="post-navigation__title"><?php echo esc_html($prev_post->post_title); ?></span>
                    </a>
                </div>
            <?php else : ?>
                <div class="post-navigation__item post-navigation__item--empty"></div>
            <?php endif; ?>

            <?php if ($next_post) : ?>
                <div class="post-navigation__item post-navigation__item--next">
                    <a href="<?php echo get_permalink($next_post); ?>" class="post-navigation__link">
                        <span class="post-navigation__label">
                            次の記事
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M5 12h14M12 5l7 7-7 7"/>
                            </svg>
                        </span>
                        <span class="post-navigation__title"><?php echo esc_html($next_post->post_title); ?></span>
                    </a>
                </div>
            <?php else : ?>
                <div class="post-navigation__item post-navigation__item--empty"></div>
            <?php endif; ?>
        </div>
    </nav>

</div><!-- .single-wrapper -->

<?php endwhile; ?>

<?php get_footer(); ?>
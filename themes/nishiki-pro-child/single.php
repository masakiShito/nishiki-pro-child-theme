<?php
/**
 * 記事詳細ページ
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<?php while (have_posts()) : the_post(); ?>

<article <?php post_class('single-article'); ?>>
    <!-- 記事ヘッダー -->
    <header class="article-header">
        <div class="article-header__container">
            <div class="article-header__meta">
                <?php
                $categories = get_the_category();
                if (!empty($categories)) :
                ?>
                    <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>" class="article-header__category">
                        <?php echo esc_html($categories[0]->name); ?>
                    </a>
                <?php endif; ?>

                <time class="article-header__date" datetime="<?php echo get_the_date('c'); ?>">
                    <?php echo get_the_date('Y年n月j日'); ?>
                </time>

                <?php if (get_the_date() !== get_the_modified_date()) : ?>
                    <span class="article-header__updated">
                        (更新: <?php echo get_the_modified_date('Y年n月j日'); ?>)
                    </span>
                <?php endif; ?>
            </div>

            <h1 class="article-header__title"><?php the_title(); ?></h1>

            <?php if (has_excerpt()) : ?>
                <p class="article-header__excerpt"><?php echo get_the_excerpt(); ?></p>
            <?php endif; ?>

            <?php
            $tags = get_the_tags();
            if ($tags) :
            ?>
                <div class="article-header__tags">
                    <?php foreach ($tags as $tag) : ?>
                        <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="article-header__tag">
                            #<?php echo esc_html($tag->name); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </header>

    <!-- アイキャッチ画像 -->
    <?php if (has_post_thumbnail()) : ?>
        <div class="article-thumbnail">
            <div class="article-thumbnail__container">
                <?php the_post_thumbnail('full', ['class' => 'article-thumbnail__img']); ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- 記事本文 -->
    <div class="article-body">
        <div class="article-body__container">
            <!-- 目次（h2があれば表示） -->
            <div class="article-toc" id="toc">
                <div class="article-toc__header">
                    <span class="article-toc__title">目次</span>
                    <button type="button" class="article-toc__toggle" aria-expanded="true">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 15l-6-6-6 6"/>
                        </svg>
                    </button>
                </div>
                <nav class="article-toc__nav" aria-label="目次">
                    <ol class="article-toc__list"></ol>
                </nav>
            </div>

            <!-- 本文 -->
            <div class="article-content">
                <?php the_content(); ?>
            </div>
        </div>
    </div>

    <!-- 記事フッター -->
    <footer class="article-footer">
        <div class="article-footer__container">
            <!-- シェアボタン -->
            <div class="article-share">
                <span class="article-share__label">Share</span>
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

            <!-- カテゴリー一覧 -->
            <?php
            $all_categories = get_the_category();
            if (!empty($all_categories)) :
            ?>
                <div class="article-categories">
                    <span class="article-categories__label">カテゴリー</span>
                    <div class="article-categories__list">
                        <?php foreach ($all_categories as $cat) : ?>
                            <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="article-categories__item">
                                <?php echo esc_html($cat->name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
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
            <h2 class="related-posts__title">関連記事</h2>
            <div class="related-posts__grid">
                <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                    <article class="related-card">
                        <a href="<?php the_permalink(); ?>" class="related-card__link">
                            <div class="related-card__image">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium', ['class' => 'related-card__img']); ?>
                                <?php else : ?>
                                    <div class="related-card__placeholder">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                            <circle cx="8.5" cy="8.5" r="1.5"/>
                                            <polyline points="21 15 16 10 5 21"/>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="related-card__content">
                                <time class="related-card__date" datetime="<?php echo get_the_date('c'); ?>">
                                    <?php echo get_the_date('Y.m.d'); ?>
                                </time>
                                <h3 class="related-card__title"><?php the_title(); ?></h3>
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

<!-- 前後の記事 -->
<nav class="post-navigation">
    <div class="post-navigation__container">
        <?php
        $prev_post = get_previous_post();
        $next_post = get_next_post();
        ?>

        <div class="post-navigation__item post-navigation__item--prev">
            <?php if ($prev_post) : ?>
                <a href="<?php echo get_permalink($prev_post); ?>" class="post-navigation__link">
                    <span class="post-navigation__label">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 12H5M12 19l-7-7 7-7"/>
                        </svg>
                        前の記事
                    </span>
                    <span class="post-navigation__title"><?php echo esc_html($prev_post->post_title); ?></span>
                </a>
            <?php endif; ?>
        </div>

        <div class="post-navigation__item post-navigation__item--next">
            <?php if ($next_post) : ?>
                <a href="<?php echo get_permalink($next_post); ?>" class="post-navigation__link">
                    <span class="post-navigation__label">
                        次の記事
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </span>
                    <span class="post-navigation__title"><?php echo esc_html($next_post->post_title); ?></span>
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<?php endwhile; ?>

<?php get_footer(); ?>

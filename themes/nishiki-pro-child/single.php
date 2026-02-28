<?php
/**
 * 記事詳細ページ - クリーン＆リーダブルデザイン
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<div class="single-wrapper">
    <?php while (have_posts()) : the_post(); ?>

    <article <?php post_class('single-article'); ?>>
        <?php
        $post_tags = get_the_tags();
        $reading_time = ceil(mb_strlen(strip_tags(get_the_content())) / 600);
        ?>

        <!-- タイトルヒーロー（画像なし） -->
        <section class="article-hero article-hero--synthetic">
            <div class="article-hero__overlay">
                <div class="article-hero__art" aria-hidden="true"></div>
                <div class="article-hero__content">
                    <p class="article-hero__subcopy" aria-label="System Engineer Blog">
                        <span class="article-hero__subcopy-text">SYSTEM ENGINEER BLOG</span>
                    </p>
                    <h1 class="article-hero__title"><?php the_title(); ?></h1>
                    <div class="article-hero__meta">
                        <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('Y年n月j日'); ?></time>
                        <span>約<?php echo $reading_time; ?>分</span>
                    </div>
                </div>
            </div>
        </section>

        <?php
        $post_categories = get_the_category();
        $related_posts = null;
        if (!empty($post_categories)) {
            $related_posts = new WP_Query(array(
                'category__in' => array($post_categories[0]->term_id),
                'post__not_in' => array(get_the_ID()),
                'posts_per_page' => 4,
                'orderby' => 'rand',
            ));
        }
        ?>

        <!-- 記事本文エリア -->
        <div class="article-main">
            <!-- メインコンテンツ -->
            <div class="article-body">
                <div class="article-content">
                    <?php the_content(); ?>
                </div>

            </div>

            <!-- 右カラム -->
            <aside class="article-sidebar">
                <!-- 目次 -->
                <div class="toc-widget" id="tocWidget">
                    <div class="toc-widget__header">
                        <div class="toc-widget__title-wrap">
                            <svg class="toc-widget__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <line x1="8" y1="6" x2="21" y2="6"/>
                                <line x1="8" y1="12" x2="21" y2="12"/>
                                <line x1="8" y1="18" x2="21" y2="18"/>
                                <line x1="3" y1="6" x2="3.01" y2="6"/>
                                <line x1="3" y1="12" x2="3.01" y2="12"/>
                                <line x1="3" y1="18" x2="3.01" y2="18"/>
                            </svg>
                            <span class="toc-widget__title">目次</span>
                        </div>
                        <button class="toc-widget__toggle" id="tocToggle" aria-expanded="true" aria-label="目次を折りたたむ">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                                <polyline points="18 15 12 9 6 15"/>
                            </svg>
                        </button>
                    </div>
                    <nav class="toc-widget__body" id="tocBody" aria-label="目次">
                        <ol class="toc-list" id="tocList"></ol>
                    </nav>
                </div>

                <?php if (!empty($post_categories)) : ?>
                    <section class="article-sidebar__section">
                        <h2 class="article-sidebar__title">カテゴリー</h2>
                        <div class="article-sidebar__chips">
                            <?php foreach ($post_categories as $cat) : ?>
                                <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="article-sidebar__chip article-sidebar__chip--category">
                                    <?php echo esc_html($cat->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>

                <section class="article-sidebar__section">
                    <h2 class="article-sidebar__title">タグ</h2>
                    <div class="article-sidebar__chips">
                        <?php if ($post_tags) : ?>
                            <?php foreach ($post_tags as $tag) : ?>
                                <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="article-sidebar__chip">
                                    #<?php echo esc_html($tag->name); ?>
                                </a>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <span class="article-sidebar__empty">タグなし</span>
                        <?php endif; ?>
                    </div>
                </section>

                <section class="article-sidebar__section article-author">
                    <div class="article-author__avatar">
                        <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
                    </div>
                    <div class="article-author__info">
                        <span class="article-author__label">この記事を書いた人</span>
                        <span class="article-author__name"><?php the_author(); ?></span>
                    </div>
                </section>

                <?php if ($related_posts && $related_posts->have_posts()) : ?>
                    <section class="article-sidebar__section">
                        <h2 class="article-sidebar__title">関連記事</h2>
                        <ul class="article-sidebar__related-list">
                            <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                                <li class="article-sidebar__related-item">
                                    <a href="<?php the_permalink(); ?>" class="article-sidebar__related-link">
                                        <span class="article-sidebar__related-title"><?php the_title(); ?></span>
                                        <time class="article-sidebar__related-date" datetime="<?php echo get_the_date('c'); ?>">
                                            <?php echo get_the_date('Y.m.d'); ?>
                                        </time>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </section>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            </aside>
        </div>
    </article>

    <!-- 前後の記事ナビゲーション -->
    <?php
    $prev_post = get_previous_post();
    $next_post = get_next_post();
    if ($prev_post || $next_post) :
    ?>
    <nav class="post-navigation">
        <div class="post-navigation__container">
            <?php if ($prev_post) : ?>
                <a href="<?php echo get_permalink($prev_post); ?>" class="post-navigation__item post-navigation__item--prev">
                    <span class="post-navigation__arrow">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 12H5M12 19l-7-7 7-7"/>
                        </svg>
                    </span>
                    <span class="post-navigation__info">
                        <span class="post-navigation__direction">前の記事</span>
                        <span class="post-navigation__title"><?php echo esc_html($prev_post->post_title); ?></span>
                    </span>
                </a>
            <?php else : ?>
                <span class="post-navigation__item post-navigation__item--prev post-navigation__item--empty"></span>
            <?php endif; ?>

            <?php if ($next_post) : ?>
                <a href="<?php echo get_permalink($next_post); ?>" class="post-navigation__item post-navigation__item--next">
                    <span class="post-navigation__arrow">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </span>
                    <span class="post-navigation__info">
                        <span class="post-navigation__direction">次の記事</span>
                        <span class="post-navigation__title"><?php echo esc_html($next_post->post_title); ?></span>
                    </span>
                </a>
            <?php else : ?>
                <span class="post-navigation__item post-navigation__item--next post-navigation__item--empty"></span>
            <?php endif; ?>
        </div>
    </nav>
    <?php endif; ?>

    <?php endwhile; ?>

    <!-- フローティングSNSシェアボタン（左側固定） -->
    <?php if (is_single()) : ?>
    <div class="sns-float" id="snsFloat" role="complementary" aria-label="SNSでシェア">
        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>"
           target="_blank" rel="noopener noreferrer"
           class="sns-float__btn sns-float__btn--x"
           aria-label="Xでシェア">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.746l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
            </svg>
        </a>
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>"
           target="_blank" rel="noopener noreferrer"
           class="sns-float__btn sns-float__btn--facebook"
           aria-label="Facebookでシェア">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
            </svg>
        </a>
        <a href="https://line.me/R/msg/text/?<?php echo urlencode(get_the_title() . ' ' . get_permalink()); ?>"
           target="_blank" rel="noopener noreferrer"
           class="sns-float__btn sns-float__btn--line"
           aria-label="LINEでシェア">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63h2.386c.349 0 .63.285.63.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.105.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63.349 0 .631.285.631.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.348 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.629 0 .344-.281.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314"/>
            </svg>
        </a>
        <a href="https://b.hatena.ne.jp/add?mode=confirm&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>"
           target="_blank" rel="noopener noreferrer"
           class="sns-float__btn sns-float__btn--hatena"
           aria-label="はてなブックマーク">
            <svg width="16" height="16" viewBox="0 0 32 32" fill="currentColor" aria-hidden="true">
                <path d="M 4 4 L 4 28 L 28 28 L 28 4 Z M 13.162109 7.3984375 C 15.739109 7.3984375 17.978516 8.5992969 17.978516 11.154297 C 17.978516 12.922297 16.886234 14.232484 15.240234 14.646484 C 17.196234 15.005484 18.519531 16.360281 18.519531 18.488281 C 18.519531 21.275281 16.170703 22.601563 13.345703 22.601563 L 7.3984375 22.601563 L 7.3984375 7.3984375 Z M 22.078125 19.3125 C 23.245125 19.3125 24.191406 20.258344 24.191406 21.427344 C 24.191406 22.594344 23.245125 23.541016 22.078125 23.541016 C 20.909125 23.541016 19.964844 22.594344 19.964844 21.427344 C 19.964844 20.258344 20.909125 19.3125 22.078125 19.3125 Z M 22.078125 7.3984375 L 22.078125 17.373047 L 19.964844 17.373047 L 19.964844 7.3984375 Z M 12.755859 9.5859375 L 10.046875 9.5859375 L 10.046875 13.791016 L 12.755859 13.791016 C 14.193859 13.791016 15.056641 13.080969 15.056641 11.654969 C 15.056641 10.302969 14.193859 9.5859375 12.755859 9.5859375 Z M 13.029297 15.888672 L 10.046875 15.888672 L 10.046875 20.427734 L 13.029297 20.427734 C 14.703297 20.427734 15.599609 19.591844 15.599609 18.089844 C 15.599609 16.587844 14.703297 15.888672 13.029297 15.888672 Z"/>
            </svg>
        </a>
    </div>
    <?php endif; ?>
</div><!-- .single-wrapper -->

<?php get_footer(); ?>

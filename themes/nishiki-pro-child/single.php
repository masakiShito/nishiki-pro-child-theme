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
                        <time datetime="<?php echo get_the_date('c'); ?>">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            <?php echo get_the_date('Y年n月j日'); ?>
                        </time>
                        <span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            約<?php echo $reading_time; ?>分で読めます
                        </span>
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
                'orderby' => 'date',
                'order' => 'DESC',
            ));
        }
        ?>

        <!-- 記事本文エリア -->
        <div class="article-main article-main--with-toc">
            <!-- 左：目次サイドバー -->
            <aside class="toc-sidebar" id="tocSidebar">
                <div class="toc-sidebar__inner" id="tocWidget">
                    <div class="toc-sidebar__header">
                        <span class="toc-sidebar__label">CONTENTS</span>
                        <span class="toc-sidebar__progress" id="tocProgress">0%</span>
                    </div>
                    <nav class="toc-sidebar__body" id="tocBody" aria-label="目次">
                        <ol class="toc-timeline" id="tocList"></ol>
                    </nav>
                </div>
            </aside>

            <!-- メインコンテンツ -->
            <div class="article-body">
                <div class="article-content">
                    <?php the_content(); ?>
                </div>
            </div>

            <!-- 右カラム -->
            <aside class="article-sidebar">
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

    <?php get_template_part('components/post-navigation', null, array(
        'prev_label' => '前の記事',
        'next_label' => '次の記事',
    )); ?>

    <?php endwhile; ?>

    <?php get_template_part('components/sns-share'); ?>
</div><!-- .single-wrapper -->

<?php get_footer(); ?>

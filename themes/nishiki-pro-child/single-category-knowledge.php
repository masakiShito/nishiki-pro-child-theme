<?php
/**
 * ナレッジカテゴリ用記事テンプレート - デジタルライブラリ/マガジン風
 * 図書館のカード目録や洗練された雑誌記事のようなエレガントなデザイン
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<div class="single-wrapper single-wrapper--knowledge">
    <?php while (have_posts()) : the_post(); ?>

    <article <?php post_class('single-article single-article--knowledge'); ?>>
        <?php
        $post_tags = get_the_tags();
        $reading_time = ceil(mb_strlen(strip_tags(get_the_content())) / 600);
        $post_categories = get_the_category();
        ?>

        <!-- マガジン風ヒーロー -->
        <section class="knowledge-hero">
            <div class="knowledge-hero__container">
                <!-- 装飾ライン -->
                <div class="knowledge-hero__accent-line" aria-hidden="true"></div>

                <!-- カテゴリラベル -->
                <div class="knowledge-hero__topbar">
                    <?php if (!empty($post_categories)) : ?>
                    <div class="knowledge-hero__category-badge">
                        <span class="knowledge-hero__category-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="14" height="14"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                        </span>
                        <?php foreach ($post_categories as $cat) : ?>
                            <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="knowledge-hero__cat-link"><?php echo esc_html($cat->name); ?></a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <div class="knowledge-hero__reading-time">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="14" height="14"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        <span><?php echo $reading_time; ?>分で読了</span>
                    </div>
                </div>

                <!-- タイトルエリア -->
                <div class="knowledge-hero__title-block">
                    <h1 class="knowledge-hero__title"><?php the_title(); ?></h1>
                    <div class="knowledge-hero__subtitle-line" aria-hidden="true"></div>
                </div>

                <!-- 著者・日付カード -->
                <div class="knowledge-hero__info-card">
                    <div class="knowledge-hero__author">
                        <div class="knowledge-hero__author-avatar">
                            <?php echo get_avatar(get_the_author_meta('ID'), 56); ?>
                        </div>
                        <div class="knowledge-hero__author-detail">
                            <span class="knowledge-hero__author-label">Written by</span>
                            <span class="knowledge-hero__author-name"><?php the_author(); ?></span>
                        </div>
                    </div>
                    <div class="knowledge-hero__dates">
                        <div class="knowledge-hero__date-item">
                            <span class="knowledge-hero__date-label">Published</span>
                            <time class="knowledge-hero__date-value" datetime="<?php echo get_the_date('c'); ?>">
                                <?php echo get_the_date('Y年n月j日'); ?>
                            </time>
                        </div>
                        <div class="knowledge-hero__date-item">
                            <span class="knowledge-hero__date-label">Updated</span>
                            <time class="knowledge-hero__date-value" datetime="<?php echo get_the_modified_date('c'); ?>">
                                <?php echo get_the_modified_date('Y年n月j日'); ?>
                            </time>
                        </div>
                    </div>
                </div>

                <!-- タグ -->
                <?php if ($post_tags) : ?>
                <div class="knowledge-hero__tags">
                    <?php foreach ($post_tags as $tag) : ?>
                        <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="knowledge-hero__tag"><?php echo esc_html($tag->name); ?></a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </section>

        <?php
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
        <div class="article-main article-main--knowledge">
            <div class="article-body article-body--knowledge">
                <!-- 目次（インデックスカード風） -->
                <div class="toc-widget toc-widget--knowledge toc-widget--inline" id="tocWidget">
                    <div class="toc-widget__header toc-widget__header--knowledge">
                        <div class="toc-widget__title-wrap">
                            <span class="toc-widget__title-number">INDEX</span>
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

                <div class="article-content">
                    <?php the_content(); ?>
                </div>
            </div>

            <!-- サイドバー -->
            <aside class="article-sidebar article-sidebar--knowledge">
                <!-- ブックマーク風カテゴリ -->
                <?php if (!empty($post_categories)) : ?>
                    <section class="knowledge-sidebar__section">
                        <h2 class="knowledge-sidebar__section-title">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="14" height="14"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
                            カテゴリー
                        </h2>
                        <div class="knowledge-sidebar__chips">
                            <?php foreach ($post_categories as $cat) : ?>
                                <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="knowledge-sidebar__chip knowledge-sidebar__chip--category">
                                    <?php echo esc_html($cat->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>

                <!-- タグ -->
                <section class="knowledge-sidebar__section">
                    <h2 class="knowledge-sidebar__section-title">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="14" height="14"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
                        タグ
                    </h2>
                    <div class="knowledge-sidebar__chips">
                        <?php if ($post_tags) : ?>
                            <?php foreach ($post_tags as $tag) : ?>
                                <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="knowledge-sidebar__chip">
                                    <?php echo esc_html($tag->name); ?>
                                </a>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <span class="knowledge-sidebar__empty">タグなし</span>
                        <?php endif; ?>
                    </div>
                </section>

                <!-- 関連ナレッジ -->
                <?php if ($related_posts && $related_posts->have_posts()) : ?>
                    <section class="knowledge-sidebar__section">
                        <h2 class="knowledge-sidebar__section-title">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="14" height="14"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                            関連ナレッジ
                        </h2>
                        <ul class="knowledge-sidebar__related-list">
                            <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                                <li class="knowledge-sidebar__related-item">
                                    <a href="<?php the_permalink(); ?>" class="knowledge-sidebar__related-link">
                                        <span class="knowledge-sidebar__related-title"><?php the_title(); ?></span>
                                        <time class="knowledge-sidebar__related-date" datetime="<?php echo get_the_date('c'); ?>">
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
        'prev_label' => '前のナレッジ',
        'next_label' => '次のナレッジ',
        'modifier_class' => 'post-navigation--knowledge',
    )); ?>

    <?php endwhile; ?>

    <?php get_template_part('components/sns-share'); ?>
</div>

<?php get_footer(); ?>

<?php
/**
 * 開発カテゴリ用記事テンプレート - 技術ブログ風
 * ターミナル/コードエディタの雰囲気を強調したデザイン
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<div class="single-wrapper single-wrapper--dev">
    <?php while (have_posts()) : the_post(); ?>

    <article <?php post_class('single-article single-article--dev'); ?>>
        <?php
        $post_tags = get_the_tags();
        $reading_time = ceil(mb_strlen(strip_tags(get_the_content())) / 600);
        $post_categories = get_the_category();
        ?>

        <!-- ターミナル風ヒーロー -->
        <section class="dev-hero">
            <div class="dev-hero__terminal">
                <div class="dev-hero__terminal-bar">
                    <span class="dev-hero__terminal-dot dev-hero__terminal-dot--red"></span>
                    <span class="dev-hero__terminal-dot dev-hero__terminal-dot--yellow"></span>
                    <span class="dev-hero__terminal-dot dev-hero__terminal-dot--green"></span>
                    <span class="dev-hero__terminal-tab">article.md</span>
                </div>
                <div class="dev-hero__terminal-body">
                    <div class="dev-hero__breadcrumb">
                        <span class="dev-hero__prompt">$</span>
                        <span class="dev-hero__path">~/blog/<?php
                            if (!empty($post_categories)) {
                                echo esc_html($post_categories[0]->slug);
                            }
                        ?>/</span>
                    </div>
                    <h1 class="dev-hero__title"><?php the_title(); ?></h1>
                    <div class="dev-hero__meta">
                        <span class="dev-hero__meta-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            <?php echo get_the_date('Y-m-d'); ?>
                        </span>
                        <span class="dev-hero__meta-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            <?php echo $reading_time; ?> min read
                        </span>
                        <?php if (!empty($post_categories)) : ?>
                        <span class="dev-hero__meta-item dev-hero__meta-item--cat">
                            <?php foreach ($post_categories as $cat) : ?>
                                <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="dev-hero__cat-link"><?php echo esc_html($cat->name); ?></a>
                            <?php endforeach; ?>
                        </span>
                        <?php endif; ?>
                    </div>
                    <?php if ($post_tags) : ?>
                    <div class="dev-hero__tags">
                        <?php foreach ($post_tags as $tag) : ?>
                            <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="dev-hero__tag">#<?php echo esc_html($tag->name); ?></a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
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

            <div class="article-body">
                <div class="article-content">
                    <?php the_content(); ?>
                </div>
            </div>

            <!-- サイドバー -->
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
                        <span class="article-author__label">Author</span>
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
</div>

<?php get_footer(); ?>

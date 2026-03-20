<?php
/**
 * インフラカテゴリ用記事テンプレート - サーバーダッシュボード風
 * ネットワーク監視コンソール・ブループリントのような本格的デザイン
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<div class="single-wrapper single-wrapper--infra">
    <?php while (have_posts()) : the_post(); ?>

    <article <?php post_class('single-article single-article--infra'); ?>>
        <?php
        $post_tags = get_the_tags();
        $reading_time = ceil(mb_strlen(strip_tags(get_the_content())) / 600);
        $post_categories = get_the_category();
        $modified_date = get_the_modified_date('Y-m-d H:i');
        $created_date = get_the_date('Y-m-d H:i');
        ?>

        <!-- ダッシュボード風ヒーロー -->
        <section class="infra-hero">
            <div class="infra-hero__grid-overlay" aria-hidden="true"></div>
            <div class="infra-hero__container">
                <!-- ステータスバー -->
                <div class="infra-hero__status-bar">
                    <div class="infra-hero__status-left">
                        <span class="infra-hero__status-indicator">
                            <span class="infra-hero__status-dot"></span>
                            DOCUMENT ACTIVE
                        </span>
                        <span class="infra-hero__status-id">ID: <?php echo get_the_ID(); ?></span>
                    </div>
                    <div class="infra-hero__status-right">
                        <span class="infra-hero__status-region">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="14" height="14"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            INFRASTRUCTURE
                        </span>
                    </div>
                </div>

                <!-- パンくずリスト -->
                <nav class="infra-hero__breadcrumb" aria-label="パンくずリスト">
                    <span class="infra-hero__breadcrumb-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="14" height="14"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                    </span>
                    <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                    <span class="infra-hero__breadcrumb-sep">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="12" height="12"><polyline points="9 18 15 12 9 6"/></svg>
                    </span>
                    <?php if (!empty($post_categories)) : ?>
                        <a href="<?php echo esc_url(get_category_link($post_categories[0]->term_id)); ?>"><?php echo esc_html($post_categories[0]->name); ?></a>
                        <span class="infra-hero__breadcrumb-sep">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="12" height="12"><polyline points="9 18 15 12 9 6"/></svg>
                        </span>
                    <?php endif; ?>
                    <span class="infra-hero__breadcrumb-current"><?php the_title(); ?></span>
                </nav>

                <!-- タイトルエリア -->
                <div class="infra-hero__title-area">
                    <h1 class="infra-hero__title"><?php the_title(); ?></h1>
                    <?php if ($post_tags) : ?>
                    <div class="infra-hero__tags">
                        <?php foreach ($post_tags as $tag) : ?>
                            <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="infra-hero__tag">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="10" height="10"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
                                <?php echo esc_html($tag->name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- メトリクスパネル -->
                <div class="infra-hero__metrics">
                    <div class="infra-hero__metric">
                        <span class="infra-hero__metric-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="18" height="18"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        </span>
                        <div class="infra-hero__metric-content">
                            <span class="infra-hero__metric-label">CREATED</span>
                            <time class="infra-hero__metric-value" datetime="<?php echo get_the_date('c'); ?>">
                                <?php echo esc_html($created_date); ?>
                            </time>
                        </div>
                    </div>
                    <div class="infra-hero__metric">
                        <span class="infra-hero__metric-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="18" height="18"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg>
                        </span>
                        <div class="infra-hero__metric-content">
                            <span class="infra-hero__metric-label">LAST UPDATED</span>
                            <time class="infra-hero__metric-value" datetime="<?php echo get_the_modified_date('c'); ?>">
                                <?php echo esc_html($modified_date); ?>
                            </time>
                        </div>
                    </div>
                    <div class="infra-hero__metric">
                        <span class="infra-hero__metric-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="18" height="18"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </span>
                        <div class="infra-hero__metric-content">
                            <span class="infra-hero__metric-label">READ TIME</span>
                            <span class="infra-hero__metric-value"><?php echo $reading_time; ?> min</span>
                        </div>
                    </div>
                    <div class="infra-hero__metric">
                        <span class="infra-hero__metric-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="18" height="18"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </span>
                        <div class="infra-hero__metric-content">
                            <span class="infra-hero__metric-label">AUTHOR</span>
                            <span class="infra-hero__metric-value"><?php the_author(); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
        $related_posts = null;
        if (!empty($post_categories)) {
            $related_posts = new WP_Query(array(
                'category__in' => array($post_categories[0]->term_id),
                'post__not_in' => array(get_the_ID()),
                'posts_per_page' => 5,
                'orderby' => 'date',
                'order' => 'DESC',
            ));
        }
        ?>

        <!-- 記事本文エリア -->
        <div class="article-main article-main--infra article-main--with-toc">
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
            <div class="article-body article-body--infra">
                <div class="article-content">
                    <?php the_content(); ?>
                </div>

                <!-- 記事フッター情報 -->
                <footer class="infra-article-footer">
                    <div class="infra-article-footer__divider">
                        <span class="infra-article-footer__divider-text">END OF DOCUMENT</span>
                    </div>
                    <div class="infra-article-footer__content">
                        <div class="infra-article-footer__author">
                            <?php echo get_avatar(get_the_author_meta('ID'), 48); ?>
                            <div class="infra-article-footer__author-info">
                                <span class="infra-article-footer__author-label">DOCUMENT AUTHOR</span>
                                <span class="infra-article-footer__author-name"><?php the_author(); ?></span>
                            </div>
                        </div>
                        <?php if (!empty($post_categories)) : ?>
                        <div class="infra-article-footer__categories">
                            <?php foreach ($post_categories as $cat) : ?>
                                <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="infra-article-footer__cat">
                                    <?php echo esc_html($cat->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </footer>
            </div>

            <!-- サイドバー（右配置） -->
            <aside class="article-sidebar article-sidebar--infra">
                <!-- システムナビゲーション -->
                <div class="infra-sidebar__nav-header">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="14" height="14"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                    <span>NAVIGATION PANEL</span>
                </div>

                <!-- 関連ドキュメント -->
                <?php if ($related_posts && $related_posts->have_posts()) : ?>
                    <div class="infra-sidebar__section">
                        <div class="infra-sidebar__section-header">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="14" height="14"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><polyline points="13 2 13 9 20 9"/></svg>
                            <span>RELATED DOCS</span>
                        </div>
                        <ul class="infra-sidebar__doc-list">
                            <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                                <li class="infra-sidebar__doc-item">
                                    <a href="<?php the_permalink(); ?>" class="infra-sidebar__doc-link">
                                        <span class="infra-sidebar__doc-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="12" height="12"><polyline points="9 18 15 12 9 6"/></svg>
                                        </span>
                                        <span class="infra-sidebar__doc-info">
                                            <span class="infra-sidebar__doc-title"><?php the_title(); ?></span>
                                            <time class="infra-sidebar__doc-date" datetime="<?php echo get_the_date('c'); ?>">
                                                <?php echo get_the_date('Y-m-d'); ?>
                                            </time>
                                        </span>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>

                <!-- ドキュメント情報 -->
                <div class="infra-sidebar__section">
                    <div class="infra-sidebar__section-header">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="14" height="14"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                        <span>DOC INFO</span>
                    </div>
                    <div class="infra-sidebar__info-grid">
                        <div class="infra-sidebar__info-row">
                            <span class="infra-sidebar__info-key">Status</span>
                            <span class="infra-sidebar__info-val infra-sidebar__info-val--active">Published</span>
                        </div>
                        <div class="infra-sidebar__info-row">
                            <span class="infra-sidebar__info-key">Version</span>
                            <span class="infra-sidebar__info-val"><?php echo get_post_meta(get_the_ID(), '_edit_last', true) ? 'rev.' . get_the_modified_date('ymd') : '1.0'; ?></span>
                        </div>
                        <div class="infra-sidebar__info-row">
                            <span class="infra-sidebar__info-key">Category</span>
                            <span class="infra-sidebar__info-val"><?php echo !empty($post_categories) ? esc_html($post_categories[0]->name) : '-'; ?></span>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </article>

    <?php get_template_part('components/post-navigation', null, array(
        'prev_label' => 'PREV DOCUMENT',
        'next_label' => 'NEXT DOCUMENT',
        'modifier_class' => 'post-navigation--infra',
    )); ?>

    <?php endwhile; ?>

    <?php get_template_part('components/sns-share'); ?>
</div>

<?php get_footer(); ?>

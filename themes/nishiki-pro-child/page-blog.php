<?php
/**
 * Template Name: Blog List
 * ブログ記事一覧ページ (/blog)
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$paged = max(1, get_query_var('paged'), get_query_var('page'));
$posts_per_page = (int) get_option('posts_per_page');

$blog_query = new WP_Query(array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'ignore_sticky_posts' => true,
    'posts_per_page' => $posts_per_page,
    'paged' => $paged,
));

$total_posts = (int) $blog_query->found_posts;
?>

<div class="archive-page blog-list-page">
    <div class="scroll-indicator">
        <div class="scroll-indicator__bar"></div>
    </div>

    <section class="archive-hero">
        <div class="archive-hero__shapes">
            <div class="archive-hero__shape archive-hero__shape--1"></div>
            <div class="archive-hero__shape archive-hero__shape--2"></div>
            <div class="archive-hero__shape archive-hero__shape--3"></div>
        </div>
        <div class="archive-hero__container">
            <div class="archive-hero__content">
                <span class="archive-hero__label">Blog</span>
                <h1 class="archive-hero__title">記事一覧</h1>
                <p class="archive-hero__description">技術メモ、開発知見、学習ログをまとめています。</p>
                <div class="archive-hero__stats">
                    <div class="archive-hero__stat">
                        <span class="archive-hero__stat-value" data-count="<?php echo esc_attr($total_posts); ?>"><?php echo esc_html($total_posts); ?></span>
                        <span class="archive-hero__stat-label">記事</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="archive-filter">
        <div class="archive-filter__container">
            <div class="archive-filter__inner">
                <div class="archive-filter__info">
                    <span class="archive-filter__result">
                        <strong><?php echo esc_html($total_posts); ?></strong>件の記事が見つかりました
                    </span>
                </div>
                <div class="archive-filter__view">
                    <button class="archive-filter__view-btn is-active" data-view="grid" aria-label="グリッド表示">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="7" height="7"/>
                            <rect x="14" y="3" width="7" height="7"/>
                            <rect x="14" y="14" width="7" height="7"/>
                            <rect x="3" y="14" width="7" height="7"/>
                        </svg>
                    </button>
                    <button class="archive-filter__view-btn" data-view="list" aria-label="リスト表示">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="8" y1="6" x2="21" y2="6"/>
                            <line x1="8" y1="12" x2="21" y2="12"/>
                            <line x1="8" y1="18" x2="21" y2="18"/>
                            <line x1="3" y1="6" x2="3.01" y2="6"/>
                            <line x1="3" y1="12" x2="3.01" y2="12"/>
                            <line x1="3" y1="18" x2="3.01" y2="18"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <section class="archive-content">
        <div class="archive-content__container">
            <?php if ($blog_query->have_posts()) : ?>
                <div class="article-grid">
                    <?php while ($blog_query->have_posts()) : $blog_query->the_post();
                        $article_categories = get_the_category();
                    ?>
                        <article <?php post_class('article-card'); ?> data-category="<?php echo !empty($article_categories) ? esc_attr($article_categories[0]->slug) : ''; ?>">
                            <a href="<?php the_permalink(); ?>" class="article-card__link">
                                <div class="article-card__image">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('medium_large', array('class' => 'article-card__img', 'loading' => 'lazy')); ?>
                                    <?php else : ?>
                                        <div class="article-card__placeholder">
                                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                                <polyline points="21 15 16 10 5 21"/>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                    <div class="article-card__overlay"></div>
                                </div>

                                <div class="article-card__content">
                                    <div class="article-card__meta">
                                        <?php if (!empty($article_categories)) : ?>
                                            <span class="article-card__category"><?php echo esc_html($article_categories[0]->name); ?></span>
                                        <?php endif; ?>
                                        <time class="article-card__date" datetime="<?php echo get_the_date('c'); ?>">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                                <line x1="16" y1="2" x2="16" y2="6"/>
                                                <line x1="8" y1="2" x2="8" y2="6"/>
                                                <line x1="3" y1="10" x2="21" y2="10"/>
                                            </svg>
                                            <?php echo get_the_date('Y.m.d'); ?>
                                        </time>
                                    </div>

                                    <h2 class="article-card__title"><?php the_title(); ?></h2>

                                    <p class="article-card__excerpt">
                                        <?php echo wp_trim_words(get_the_excerpt(), 60, '...'); ?>
                                    </p>

                                    <div class="article-card__footer">
                                        <span class="article-card__read-more">
                                            続きを読む
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <line x1="5" y1="12" x2="19" y2="12"/>
                                                <polyline points="12 5 19 12 12 19"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </article>
                    <?php endwhile; ?>
                </div>

                <?php
                $base = trailingslashit(get_permalink()) . '%_%';
                $format = get_option('permalink_structure') ? 'page/%#%/' : '?paged=%#%';
                $pagination = paginate_links(array(
                    'base' => $base,
                    'format' => $format,
                    'current' => $paged,
                    'total' => $blog_query->max_num_pages,
                    'prev_text' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg><span>前へ</span>',
                    'next_text' => '<span>次へ</span><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>',
                    'type' => 'array',
                    'mid_size' => 2,
                ));

                if ($pagination) :
                ?>
                    <nav class="pagination" aria-label="ページナビゲーション">
                        <ul class="pagination__list">
                            <?php foreach ($pagination as $page_link) : ?>
                                <li class="pagination__item"><?php echo $page_link; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                <?php endif; ?>

                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <div class="archive-empty">
                    <div class="archive-empty__icon">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="12" y1="18" x2="12" y2="12"/>
                            <line x1="9" y1="15" x2="15" y2="15"/>
                        </svg>
                    </div>
                    <h2 class="archive-empty__title">記事がまだありません</h2>
                    <p class="archive-empty__text">最初の記事を投稿するとここに表示されます。</p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="archive-empty__button">ホームへ戻る</a>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>

<?php get_footer(); ?>

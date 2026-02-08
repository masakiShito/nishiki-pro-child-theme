<?php
/**
 * ブログ記事一覧ページ - モダンマガジンスタイル
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

// Get all categories for filter
$categories = get_categories([
    'orderby' => 'count',
    'order' => 'DESC',
    'hide_empty' => true,
    'number' => 6
]);

// Total post count
global $wp_query;
$total_posts = $wp_query->found_posts;
?>

<div class="archive-page">
    <!-- スクロールプログレス -->
    <div class="scroll-indicator">
        <div class="scroll-indicator__bar"></div>
    </div>

    <!-- ヒーローセクション -->
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
                <p class="archive-hero__description">
                    試して、失敗して、それでも前に進んだ記録。<br>
                    日々の学びと発見を綴っています。
                </p>
                <div class="archive-hero__stats">
                    <div class="archive-hero__stat">
                        <span class="archive-hero__stat-value" data-count="<?php echo esc_attr($total_posts); ?>"><?php echo esc_html($total_posts); ?></span>
                        <span class="archive-hero__stat-label">記事</span>
                    </div>
                    <div class="archive-hero__stat">
                        <span class="archive-hero__stat-value" data-count="<?php echo count($categories); ?>"><?php echo count($categories); ?></span>
                        <span class="archive-hero__stat-label">カテゴリー</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- カテゴリーフィルター -->
    <?php if (!empty($categories)) : ?>
    <div class="archive-filter">
        <div class="archive-filter__container">
            <div class="archive-filter__inner">
                <div class="archive-filter__tabs">
                    <button class="archive-filter__tab is-active" data-category="all">
                        すべて
                        <span class="archive-filter__tab-count"><?php echo esc_html($total_posts); ?></span>
                    </button>
                    <?php foreach ($categories as $category) : ?>
                    <button class="archive-filter__tab" data-category="<?php echo esc_attr($category->slug); ?>">
                        <?php echo esc_html($category->name); ?>
                        <span class="archive-filter__tab-count"><?php echo esc_html($category->count); ?></span>
                    </button>
                    <?php endforeach; ?>
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
    <?php endif; ?>

    <!-- 記事一覧 -->
    <section class="archive-content">
        <div class="archive-content__container">
            <?php if (have_posts()) : ?>

                <?php
                // Featured article (first post on first page)
                if (!is_paged() && $wp_query->current_post === -1) :
                    the_post();
                    $featured_categories = get_the_category();
                ?>
                <article class="featured-article" data-category="<?php echo !empty($featured_categories) ? esc_attr($featured_categories[0]->slug) : ''; ?>">
                    <a href="<?php the_permalink(); ?>" class="featured-article__link">
                        <div class="featured-article__image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large', ['class' => 'featured-article__img']); ?>
                            <?php else : ?>
                                <div class="article-card__placeholder">
                                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                        <circle cx="8.5" cy="8.5" r="1.5"/>
                                        <polyline points="21 15 16 10 5 21"/>
                                    </svg>
                                </div>
                            <?php endif; ?>
                            <span class="featured-article__badge">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                </svg>
                                注目
                            </span>
                        </div>
                        <div class="featured-article__content">
                            <div class="featured-article__meta">
                                <?php if (!empty($featured_categories)) : ?>
                                    <span class="featured-article__category"><?php echo esc_html($featured_categories[0]->name); ?></span>
                                <?php endif; ?>
                                <time class="featured-article__date" datetime="<?php echo get_the_date('c'); ?>">
                                    <?php echo get_the_date('Y.m.d'); ?>
                                </time>
                            </div>
                            <h2 class="featured-article__title"><?php the_title(); ?></h2>
                            <p class="featured-article__excerpt">
                                <?php echo wp_trim_words(get_the_excerpt(), 100, '...'); ?>
                            </p>
                            <span class="featured-article__cta">
                                続きを読む
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="5" y1="12" x2="19" y2="12"/>
                                    <polyline points="12 5 19 12 12 19"/>
                                </svg>
                            </span>
                        </div>
                    </a>
                </article>
                <?php endif; ?>

                <div class="article-grid">
                    <?php while (have_posts()) : the_post();
                        $article_categories = get_the_category();
                    ?>
                        <article <?php post_class('article-card'); ?> data-category="<?php echo !empty($article_categories) ? esc_attr($article_categories[0]->slug) : ''; ?>">
                            <a href="<?php the_permalink(); ?>" class="article-card__link">
                                <div class="article-card__image">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('medium_large', ['class' => 'article-card__img', 'loading' => 'lazy']); ?>
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

                <!-- ページネーション -->
                <?php
                $pagination = paginate_links([
                    'prev_text' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg><span>前へ</span>',
                    'next_text' => '<span>次へ</span><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>',
                    'type' => 'array',
                    'mid_size' => 2,
                ]);

                if ($pagination) :
                ?>
                    <nav class="pagination" aria-label="ページナビゲーション">
                        <ul class="pagination__list">
                            <?php foreach ($pagination as $page) : ?>
                                <li class="pagination__item"><?php echo $page; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                <?php endif; ?>

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
                    <h2 class="archive-empty__title">記事が見つかりませんでした</h2>
                    <p class="archive-empty__text">まだ記事が投稿されていません。<br>新しい記事を楽しみにお待ちください。</p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="archive-empty__button">
                        ホームへ戻る
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>

<?php get_footer(); ?>

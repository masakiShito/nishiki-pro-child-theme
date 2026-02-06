<?php
/**
 * 記事一覧ページ（カテゴリー・タグ・日付アーカイブ）
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<div class="archive-page">
    <!-- ヒーローセクション -->
    <section class="archive-hero">
        <div class="archive-hero__container">
            <div class="archive-hero__content">
                <?php if (is_category()) : ?>
                    <span class="archive-hero__label">Category</span>
                    <h1 class="archive-hero__title"><?php single_cat_title(); ?></h1>
                    <?php if (category_description()) : ?>
                        <p class="archive-hero__description"><?php echo category_description(); ?></p>
                    <?php endif; ?>
                <?php elseif (is_tag()) : ?>
                    <span class="archive-hero__label">Tag</span>
                    <h1 class="archive-hero__title"><?php single_tag_title(); ?></h1>
                <?php elseif (is_date()) : ?>
                    <span class="archive-hero__label">Archive</span>
                    <h1 class="archive-hero__title">
                        <?php
                        if (is_year()) {
                            echo get_the_date('Y年');
                        } elseif (is_month()) {
                            echo get_the_date('Y年n月');
                        } elseif (is_day()) {
                            echo get_the_date('Y年n月j日');
                        }
                        ?>
                    </h1>
                <?php elseif (is_author()) : ?>
                    <span class="archive-hero__label">Author</span>
                    <h1 class="archive-hero__title"><?php the_author(); ?></h1>
                <?php else : ?>
                    <span class="archive-hero__label">Archive</span>
                    <h1 class="archive-hero__title">記事一覧</h1>
                <?php endif; ?>

                <div class="archive-hero__meta">
                    <span class="archive-hero__count">
                        <?php
                        global $wp_query;
                        printf('%s件の記事', $wp_query->found_posts);
                        ?>
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- 記事一覧 -->
    <section class="archive-content">
        <div class="archive-content__container">
            <?php if (have_posts()) : ?>
                <div class="article-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <article <?php post_class('article-card'); ?>>
                            <a href="<?php the_permalink(); ?>" class="article-card__link">
                                <div class="article-card__image">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('medium_large', ['class' => 'article-card__img']); ?>
                                    <?php else : ?>
                                        <div class="article-card__placeholder">
                                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                                <polyline points="21 15 16 10 5 21"/>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="article-card__content">
                                    <div class="article-card__meta">
                                        <?php
                                        $categories = get_the_category();
                                        if (!empty($categories)) :
                                        ?>
                                            <span class="article-card__category"><?php echo esc_html($categories[0]->name); ?></span>
                                        <?php endif; ?>
                                        <time class="article-card__date" datetime="<?php echo get_the_date('c'); ?>">
                                            <?php echo get_the_date('Y.m.d'); ?>
                                        </time>
                                    </div>

                                    <h2 class="article-card__title"><?php the_title(); ?></h2>

                                    <p class="article-card__excerpt">
                                        <?php echo wp_trim_words(get_the_excerpt(), 60, '...'); ?>
                                    </p>
                                </div>
                            </a>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- ページネーション -->
                <?php
                $pagination = paginate_links(array(
                    'prev_text' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>',
                    'next_text' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>',
                    'type' => 'array',
                ));

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
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="12" y1="18" x2="12" y2="12"/>
                            <line x1="9" y1="15" x2="15" y2="15"/>
                        </svg>
                    </div>
                    <h2 class="archive-empty__title">記事が見つかりませんでした</h2>
                    <p class="archive-empty__text">このカテゴリーにはまだ記事がありません。</p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="archive-empty__button">
                        トップページへ戻る
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>

<?php get_footer(); ?>

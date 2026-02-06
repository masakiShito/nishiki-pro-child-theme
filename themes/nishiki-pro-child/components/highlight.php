<?php
$posts_page_id = (int) get_option('page_for_posts');
$archive_link = $posts_page_id ? get_permalink($posts_page_id) : home_url('/blog/');
?>
<section class="archive-cta">
    <div class="archive-cta__container">
        <div class="archive-cta__header">
            <h2 class="archive-cta__title">All Articles</h2>
            <p class="archive-cta__lead">すべての記事一覧</p>
        </div>
        
        <div class="archive-cta__content">
            <div class="archive-cta__card">
                <div class="archive-cta__icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                    </svg>
                </div>
                <div class="archive-cta__text">
                    <h3 class="archive-cta__card-title">時系列で読む</h3>
                    <p class="archive-cta__description">すべての記事を時系列で表示。じっくり読み進めたいときに。</p>
                </div>
                <a href="<?php echo esc_url($archive_link); ?>" class="archive-cta__button">
                    記事一覧へ
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
            
            <div class="archive-cta__card">
                <div class="archive-cta__icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                </div>
                <div class="archive-cta__text">
                    <h3 class="archive-cta__card-title">カテゴリから探す</h3>
                    <p class="archive-cta__description">興味のあるテーマから記事を探して、深掘りできます。</p>
                </div>
                <a href="#categories" class="archive-cta__button archive-cta__button--secondary">
                    カテゴリへ
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

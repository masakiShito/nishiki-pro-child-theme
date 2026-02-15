<?php
// Aboutページを取得（スラッグまたはテンプレートで検索）
$about_page = get_page_by_path('about');

// スラッグで見つからない場合、page-about.phpテンプレートを使用しているページを検索
if (!$about_page) {
    $pages_with_template = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'page-about.php'
    ));
    if (!empty($pages_with_template)) {
        $about_page = $pages_with_template[0];
    }
}

// Aboutページが存在する場合のみセクションを表示
if ($about_page) :
    $about_url = get_permalink($about_page->ID);
?>
<section class="onesta-section onesta-section--about-cta">
    <div class="onesta-wrap">
        <div class="onesta-footer-cta">
            <div class="onesta-footer-cta__icon">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </div>
            <h2 class="onesta-footer-cta__title">このブログを書いている人</h2>
            <p class="onesta-footer-cta__description">
                試して、失敗して、それでも前に進む。<br>
                そんな日々の記録を残しています。
            </p>
            <a href="<?php echo esc_url($about_url); ?>" class="onesta-footer-cta__button">
                <span>もっと詳しく見る</span>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
            <div class="onesta-footer-cta__badge">About Me</div>
        </div>
    </div>
</section>
<?php endif; ?>

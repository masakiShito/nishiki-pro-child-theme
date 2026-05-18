<?php
$specforge_page = get_page_by_path('specforge');

if (!$specforge_page) {
    $pages_with_template = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'page-specforge.php',
        'number' => 1,
    ));

    if (!empty($pages_with_template)) {
        $specforge_page = $pages_with_template[0];
    }
}

if ($specforge_page) :
    $specforge_url = get_permalink($specforge_page->ID);
?>
<section class="specforge-spotlight">
    <div class="onesta-wrap">
        <div class="specforge-spotlight__panel">
            <div class="specforge-spotlight__content">
                <span class="specforge-spotlight__eyebrow">Build / Product</span>
                <h2 class="specforge-spotlight__title">specforge</h2>
                <p class="specforge-spotlight__lead">
                    設計書を、もっとわかりやすく管理しやすく作るためのドキュメント作成支援システムです。
                </p>
                <p class="specforge-spotlight__description">
                    画面仕様書、API仕様書、DB設計書などを構造化された情報として扱い、フォーマットのばらつきや入力漏れ、修正漏れを減らすことを目指しています。
                </p>
                <div class="specforge-spotlight__actions">
                    <a href="<?php echo esc_url($specforge_url); ?>" class="specforge-spotlight__button">
                        <span>紹介ページを見る</span>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="specforge-spotlight__visual" aria-hidden="true">
                <div class="specforge-spotlight__terminal">
                    <div class="specforge-spotlight__terminal-bar">
                        <span></span><span></span><span></span>
                    </div>
                    <div class="specforge-spotlight__terminal-body">
                        <div class="specforge-spotlight__line"><span class="specforge-spotlight__prompt">$</span> project / documents / sections</div>
                        <div class="specforge-spotlight__line"><span class="specforge-spotlight__prompt">&gt;</span> structured fields / tables / references</div>
                        <div class="specforge-spotlight__line"><span class="specforge-spotlight__prompt">&gt;</span> validation / quality check</div>
                        <div class="specforge-spotlight__line"><span class="specforge-spotlight__prompt">&gt;</span> ai-ready document schema</div>
                    </div>
                </div>
                <div class="specforge-spotlight__chips">
                    <span>Screen Spec</span>
                    <span>API Spec</span>
                    <span>DB Design</span>
                    <span>Quality Check</span>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

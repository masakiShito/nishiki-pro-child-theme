<section id="categories" class="categories">
    <div class="categories__container">
        <div class="categories__header">
            <h2 class="categories__title">Categories</h2>
            <p class="categories__lead">テーマごとに整理された記事。気になるトピックから探せます。</p>
        </div>
        
        <div class="categories__grid">
            <?php
            $parents = get_categories([
                'parent' => 0,
                'hide_empty' => false,
            ]);

            if (!empty($parents)) :
                foreach ($parents as $index => $category) :
                    $category_link = get_category_link($category->term_id);
                    ?>
                    <a class="category-card" href="<?php echo esc_url($category_link); ?>" data-index="<?php echo $index; ?>">
                        <div class="category-card__inner">
                            <span class="category-card__label">Category</span>
                            <h3 class="category-card__title"><?php echo esc_html($category->name); ?></h3>
                            <p class="category-card__description"><?php echo esc_html($category->description ?: 'このカテゴリの記事をまとめてチェック。'); ?></p>
                            <div class="category-card__arrow">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M5 10H15M15 10L10 5M15 10L10 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                    <?php
                endforeach;
            else :
                ?>
                <div class="category-card category-card--empty">
                    <div class="category-card__inner">
                        <span class="category-card__label">Category</span>
                        <h3 class="category-card__title">まだカテゴリがありません</h3>
                        <p class="category-card__description">まずは投稿とカテゴリを作ってください。</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

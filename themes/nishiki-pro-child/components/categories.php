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
                    $category_style_slug = nishiki_get_term_category_style($category);
                    $category_theme = nishiki_get_category_theme($category_style_slug);
                    $category_description = $category->description ?: $category_theme['description'];
                    $card_style = sprintf(
                        '--category-accent:%1$s;--category-accent-dark:%2$s;--category-accent-light:%3$s;--category-surface:%4$s;--category-palette:%5$s;--category-glow:%6$s;',
                        esc_attr($category_theme['accent']),
                        esc_attr($category_theme['accent_dark']),
                        esc_attr($category_theme['accent_light']),
                        esc_attr($category_theme['surface']),
                        esc_attr($category_theme['palette']),
                        esc_attr($category_theme['glow'])
                    );
                    ?>
                    <a class="category-card<?php echo $category_style_slug ? ' category-card--' . esc_attr($category_style_slug) : ''; ?>" href="<?php echo esc_url($category_link); ?>" data-index="<?php echo $index; ?>" style="<?php echo $card_style; ?>">
                        <div class="category-card__inner">
                            <div class="category-card__meta">
                                <span class="category-card__label"><?php echo esc_html($category_theme['label']); ?></span>
                                <span class="category-card__icon" aria-hidden="true"><?php echo esc_html($category_theme['icon']); ?></span>
                            </div>
                            <h3 class="category-card__title"><?php echo esc_html($category->name); ?></h3>
                            <p class="category-card__description"><?php echo esc_html($category_description); ?></p>
                            <div class="category-card__footer">
                                <span class="category-card__count"><?php echo esc_html((string) $category->count); ?> posts</span>
                                <div class="category-card__arrow">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M5 10H15M15 10L10 5M15 10L10 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
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

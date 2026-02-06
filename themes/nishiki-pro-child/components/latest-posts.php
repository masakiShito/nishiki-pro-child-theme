<section id="latest" class="latest-posts">
    <div class="latest-posts__container">
        <div class="latest-posts__header">
            <div class="latest-posts__header-content">
                <h2 class="latest-posts__title">Latest Posts</h2>
                <p class="latest-posts__lead">最近書いたもの。</p>
            </div>
            <div class="latest-posts__navigation">
                <button class="slider-nav slider-nav--prev" aria-label="前へ">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </button>
                <button class="slider-nav slider-nav--next" aria-label="次へ">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </button>
            </div>
        </div>

        <div class="latest-posts__slider-wrapper">
            <div class="latest-posts__slider">
                <?php
                $latest = new WP_Query([
                    'post_type' => 'post',
                    'posts_per_page' => 6,
                ]);

                if ($latest->have_posts()) :
                    while ($latest->have_posts()) :
                        $latest->the_post();
                        $categories = get_the_category();
                        ?>
                        <article class="post-slide">
                            <a href="<?php the_permalink(); ?>" class="post-slide__link">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="post-slide__image">
                                        <?php the_post_thumbnail('large'); ?>
                                    </div>
                                <?php else : ?>
                                    <div class="post-slide__image post-slide__image--placeholder">
                                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="post-slide__content">
                                    <div class="post-slide__meta">
                                        <?php if (!empty($categories)) : ?>
                                            <span class="post-slide__category"><?php echo esc_html($categories[0]->name); ?></span>
                                        <?php endif; ?>
                                        <time class="post-slide__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                            <?php echo esc_html(get_the_date('Y.m.d')); ?>
                                        </time>
                                    </div>
                                    
                                    <h3 class="post-slide__title"><?php the_title(); ?></h3>
                                    
                                    <p class="post-slide__excerpt">
                                        <?php echo esc_html(wp_trim_words(get_the_excerpt(), 30)); ?>
                                    </p>
                                </div>
                            </a>
                        </article>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <article class="post-slide post-slide--empty">
                        <div class="post-slide__content">
                            <h3 class="post-slide__title">まだ記事がありません</h3>
                            <p class="post-slide__excerpt">最初の投稿を作成するとここに表示されます。</p>
                        </div>
                    </article>
                <?php endif; ?>
            </div>
        </div>

        <div class="latest-posts__indicators"></div>
    </div>
</section>

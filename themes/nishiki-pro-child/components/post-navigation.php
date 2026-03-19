<?php
/**
 * 前後の記事ナビゲーション（共通パーツ）
 *
 * 使用可能な変数（set_query_var / get_template_part で渡す）:
 *   $args['prev_label']     - 前の記事ラベル（デフォルト: '前の記事'）
 *   $args['next_label']     - 次の記事ラベル（デフォルト: '次の記事'）
 *   $args['modifier_class'] - BEM修飾クラス（例: 'post-navigation--infra'）
 */

$prev_label     = ! empty( $args['prev_label'] ) ? $args['prev_label'] : '前の記事';
$next_label     = ! empty( $args['next_label'] ) ? $args['next_label'] : '次の記事';
$modifier_class = ! empty( $args['modifier_class'] ) ? ' ' . $args['modifier_class'] : '';

$prev_post = get_previous_post();
$next_post = get_next_post();

if ( ! $prev_post && ! $next_post ) {
    return;
}
?>
<nav class="post-navigation<?php echo esc_attr( $modifier_class ); ?>">
    <div class="post-navigation__container">
        <?php if ( $prev_post ) : ?>
            <a href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>" class="post-navigation__item post-navigation__item--prev">
                <span class="post-navigation__arrow">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                </span>
                <span class="post-navigation__info">
                    <span class="post-navigation__direction"><?php echo esc_html( $prev_label ); ?></span>
                    <span class="post-navigation__title"><?php echo esc_html( $prev_post->post_title ); ?></span>
                </span>
            </a>
        <?php else : ?>
            <span class="post-navigation__item post-navigation__item--prev post-navigation__item--empty"></span>
        <?php endif; ?>

        <?php if ( $next_post ) : ?>
            <a href="<?php echo esc_url( get_permalink( $next_post ) ); ?>" class="post-navigation__item post-navigation__item--next">
                <span class="post-navigation__info">
                    <span class="post-navigation__direction"><?php echo esc_html( $next_label ); ?></span>
                    <span class="post-navigation__title"><?php echo esc_html( $next_post->post_title ); ?></span>
                </span>
                <span class="post-navigation__arrow">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </span>
            </a>
        <?php else : ?>
            <span class="post-navigation__item post-navigation__item--next post-navigation__item--empty"></span>
        <?php endif; ?>
    </div>
</nav>

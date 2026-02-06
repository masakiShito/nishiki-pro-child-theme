<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	
	<div id="page" class="site">
		<header id="masthead" class="site-header" role="banner">
			<div class="header-container">
				<!-- ロゴ/サイトタイトル -->
				<div class="site-branding">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo-link">
						<?php
						if ( has_custom_logo() ) {
							$custom_logo_id = get_theme_mod( 'custom_logo' );
							$logo = wp_get_attachment_image_src( $custom_logo_id, 'full' );
							if ( $logo ) {
								echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" class="site-logo">';
							}
						} else {
							echo '<span class="site-title">' . esc_html( get_bloginfo( 'name' ) ) . '</span>';
						}
						?>
					</a>
				</div>

				<!-- カテゴリーナビゲーション -->
				<nav class="category-nav" aria-label="カテゴリーナビゲーション">
					<?php
					$categories = get_categories( array(
						'orderby'    => 'count',
						'order'      => 'DESC',
						'number'     => 6,
						'hide_empty' => true,
					) );

					if ( ! empty( $categories ) ) :
					?>
						<ul class="category-list">
							<?php foreach ( $categories as $category ) : ?>
								<li class="category-item">
									<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" 
									   class="category-link <?php echo ( is_category( $category->term_id ) ) ? 'is-active' : ''; ?>">
										<?php echo esc_html( $category->name ); ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</nav>

				<!-- お問い合わせボタン -->
				<div class="header-actions">
					<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="contact-button">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
							<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
						</svg>
						<span>お問い合わせ</span>
					</a>
				</div>
			</div>
		</header>

		<main id="content" class="site-content">

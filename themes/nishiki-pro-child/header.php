<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;600;700&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<div id="page" class="site">
		<header id="masthead" class="site-header" role="banner">
			<div class="header-inner">
				<!-- ロゴ/サイト名 -->
				<div class="header-brand">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-link">
						<?php if ( has_custom_logo() ) :
							$custom_logo_id = get_theme_mod( 'custom_logo' );
							$logo = wp_get_attachment_image_src( $custom_logo_id, 'full' );
							if ( $logo ) :
						?>
							<img src="<?php echo esc_url( $logo[0] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="brand-logo">
						<?php endif; else : ?>
							<span class="brand-name"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
						<?php endif; ?>
					</a>
				</div>

				<!-- メインナビゲーション（親カテゴリ + 子カテゴリドロップダウン） -->
				<nav class="header-nav" aria-label="メインナビゲーション">
					<?php
					// 親カテゴリのみ取得
					$parent_categories = get_categories( array(
						'orderby'    => 'count',
						'order'      => 'DESC',
						'hide_empty' => true,
						'parent'     => 0, // 親カテゴリのみ
					) );

					if ( ! empty( $parent_categories ) ) :
					?>
						<ul class="nav-list">
							<?php foreach ( $parent_categories as $parent ) :
								// 子カテゴリを取得
								$child_categories = get_categories( array(
									'orderby'    => 'name',
									'order'      => 'ASC',
									'hide_empty' => true,
									'parent'     => $parent->term_id,
								) );
								$has_children = ! empty( $child_categories );
							?>
								<li class="nav-item <?php echo $has_children ? 'has-dropdown' : ''; ?>">
									<a href="<?php echo esc_url( get_category_link( $parent->term_id ) ); ?>"
									   class="nav-link <?php echo ( is_category( $parent->term_id ) ) ? 'is-current' : ''; ?>">
										<span class="nav-text"><?php echo esc_html( $parent->name ); ?></span>
										<?php if ( $has_children ) : ?>
											<svg class="nav-arrow" width="10" height="10" viewBox="0 0 10 10" fill="none">
												<path d="M2.5 4L5 6.5L7.5 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
											</svg>
										<?php endif; ?>
									</a>

									<?php if ( $has_children ) : ?>
										<div class="dropdown">
											<div class="dropdown-inner">
												<div class="dropdown-header">
													<span class="dropdown-title"><?php echo esc_html( $parent->name ); ?></span>
													<span class="dropdown-count"><?php echo esc_html( $parent->count ); ?> posts</span>
												</div>
												<ul class="dropdown-list">
													<?php foreach ( $child_categories as $child ) : ?>
														<li class="dropdown-item">
															<a href="<?php echo esc_url( get_category_link( $child->term_id ) ); ?>"
															   class="dropdown-link <?php echo ( is_category( $child->term_id ) ) ? 'is-current' : ''; ?>">
																<span class="dropdown-link-text"><?php echo esc_html( $child->name ); ?></span>
																<span class="dropdown-link-count"><?php echo esc_html( $child->count ); ?></span>
															</a>
														</li>
													<?php endforeach; ?>
												</ul>
												<a href="<?php echo esc_url( get_category_link( $parent->term_id ) ); ?>" class="dropdown-view-all">
													すべて見る
													<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
														<path d="M5 12h14M12 5l7 7-7 7"/>
													</svg>
												</a>
											</div>
										</div>
									<?php endif; ?>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</nav>

				<!-- アクション -->
				<div class="header-actions">
					<button type="button" class="menu-toggle" aria-label="メニューを開く" aria-expanded="false">
						<span class="menu-toggle-bar"></span>
						<span class="menu-toggle-bar"></span>
						<span class="menu-toggle-bar"></span>
					</button>
				</div>
			</div>

			<!-- スクロールプログレス -->
			<div class="header-progress"></div>
		</header>

		<!-- モバイルメニュー -->
		<div id="mobile-menu" class="mobile-menu" aria-hidden="true">
			<div class="mobile-menu-overlay"></div>
			<div class="mobile-menu-panel">
				<div class="mobile-menu-header">
					<span class="mobile-menu-title">Menu</span>
					<button type="button" class="mobile-menu-close" aria-label="メニューを閉じる">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
							<path d="M18 6L6 18M6 6l12 12"/>
						</svg>
					</button>
				</div>

				<nav class="mobile-nav">
					<?php if ( ! empty( $parent_categories ) ) : ?>
						<ul class="mobile-nav-list">
							<?php foreach ( $parent_categories as $index => $parent ) :
								$child_categories = get_categories( array(
									'orderby' => 'name',
									'order' => 'ASC',
									'hide_empty' => true,
									'parent' => $parent->term_id,
								) );
								$has_children = ! empty( $child_categories );
							?>
								<li class="mobile-nav-item <?php echo $has_children ? 'has-children' : ''; ?>" style="--i: <?php echo $index; ?>">
									<div class="mobile-nav-parent">
										<a href="<?php echo esc_url( get_category_link( $parent->term_id ) ); ?>" class="mobile-nav-link">
											<?php echo esc_html( $parent->name ); ?>
										</a>
										<?php if ( $has_children ) : ?>
											<button type="button" class="mobile-nav-toggle" aria-expanded="false">
												<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
													<path d="M12 5v14M5 12h14"/>
												</svg>
											</button>
										<?php endif; ?>
									</div>
									<?php if ( $has_children ) : ?>
										<ul class="mobile-nav-children">
											<?php foreach ( $child_categories as $child ) : ?>
												<li>
													<a href="<?php echo esc_url( get_category_link( $child->term_id ) ); ?>" class="mobile-nav-child-link">
														<?php echo esc_html( $child->name ); ?>
													</a>
												</li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</nav>
			</div>
		</div>

		<main id="content" class="site-content">

<?php
/**
 * 子テーマ用フッター（シンプル・明るいデザイン）
 */

?>
				<?php do_action( 'nishiki_pro_after_inner_content' ); ?>
			</div>
			<?php do_action( 'nishiki_pro_after_content' ); ?>
			<?php do_action( 'nishiki_pro_before_site_footer' ); ?>
			
			<!-- シンプルで明るいフッター -->
			<footer id="footer" role="contentinfo" class="simple-footer">
				<?php do_action( 'nishiki_pro_before_site_footer_content' ); ?>
				<div class="simple-footer__container">
					<p class="simple-footer__copyright">
						© <?php echo date('Y'); ?> <?php bloginfo('name'); ?>
					</p>
				</div>
				<?php do_action( 'nishiki_pro_after_site_footer_content' ); ?>
			</footer>
			
			<?php do_action( 'nishiki_pro_after_site_footer' ); ?>
		</div>
		<?php wp_footer(); ?>
		<?php do_action( 'nishiki_pro_body_close' ); ?>
	</body>
</html>

<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "body-content-wrapper" div and all content after.
 *
 * @subpackage fPhotography
 * @author tishonator
 * @since fPhotography 1.0.0
 *
 */
?>
			<a href="#" class="scrollup"></a>

			<footer id="footer-main">

				<div id="footer-content-wrapper">

					<?php get_sidebar('footer'); ?>

					<div class="clear">
					</div>

					<div id="copyright">

						<p>
						 <?php fphotography_show_copyright_text(); ?> <a href="<?php echo esc_url( 'https://tishonator.com/product/fphotography' ); ?>" title="<?php esc_attr_e( 'fphotography Theme', 'fphotography' ); ?>">
							<?php _e('fPhotography Theme', 'fphotography'); ?></a> <?php esc_attr_e( 'powered by', 'fphotography' ); ?> <a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>" title="<?php esc_attr_e( 'WordPress', 'fphotography' ); ?>">
							<?php _e('WordPress', 'fphotography'); ?></a>
						</p>
						
					</div><!-- #copyright -->

				</div><!-- #footer-content-wrapper -->

			</footer><!-- #footer-main -->

		</div><!-- #body-content-wrapper -->
		<?php wp_footer(); ?>
	</body>
</html>
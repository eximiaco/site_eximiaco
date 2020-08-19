<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

global $container;

?>

	<?php if ( ! is_front_page() && ( ! is_page_template() || is_page_template( 'page-templates/contact.php' ) ) ) : ?>
	</div><!-- .container -->
	<?php endif; ?>

	<?php if ( is_front_page() ) : ?>
		<div class="container">
			<?php get_template_part( 'template-parts/footer/promotion' ); ?>
		</div>
	<?php endif; ?>

	<?php
	if ( ! is_page_template( 'page-templates/contact.php' ) ) :
		get_template_part( 'template-parts/newsletter/form' );
		endif;
	?>

	<div class="footer-info">
		<div class="container">
			<div class="info">
				<!-- Widget Area 1 -->
				<?php
					if ( is_active_sidebar( 'widgets_area_footer_1' ) ) {
						dynamic_sidebar( 'widgets_area_footer_1' );
					}
				?>
				<div class="info__content">
					<!-- Widget Area 2 -->
					<?php
						if ( is_active_sidebar( 'widgets_area_footer_2' ) ) {
							dynamic_sidebar( 'widgets_area_footer_2' );
						}
					?>
					<!-- Widget Area 3 -->
					<?php
						if ( is_active_sidebar( 'widgets_area_footer_3' ) ) {
							dynamic_sidebar( 'widgets_area_footer_3' );
						}
					?>
					<!-- Widget Area 4 -->
					<?php
						if ( is_active_sidebar( 'widgets_area_footer_4' ) ) {
							dynamic_sidebar( 'widgets_area_footer_4' );
						}
					?>
				</div>
			</div>
		</div>
	</div>

</div><!-- #site-content -->

<footer id="colophon" class="site-footer">
	<div class="scroll-up">
		<div class="scroll-up--icon">
			<i class="i-arrow-right"></i>
		</div>
	</div>
	<div class="follow-us">
		<?php get_template_part( 'template-parts/social-menu' ); ?>
	</div>
</footer><!-- #colophon -->

<?php wp_footer(); ?>
</body>
</html>

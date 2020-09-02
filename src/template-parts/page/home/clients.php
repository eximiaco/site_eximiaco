<?php
/**
 * Latest posts on homepage
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

if ( empty( get_field( 'clients_testimonial_title' ) ) )  {
	return;
}
?>

<div class="front-page--clients-testimonials container">
	<h2 class="front-page--clients-testimonials-title">
		<?php echo wp_kses_post( get_field( 'clients_testimonial_title' ) ); ?>
	</h2>
	<?php get_template_part( 'template-parts/client/clients-swiper' ); ?>
</div>

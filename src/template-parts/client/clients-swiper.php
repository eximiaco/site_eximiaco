<?php
/**
 * Our Clients component.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

use Aztec\Helper\PageSection;

global $container;
$clients = $container->get( Aztec\PostType\Client::class )->get_clients();

if ( ! $clients->have_posts() ) {
	return;
}

$slug = PLL()->curlang->slug;
?>

<div class="clients-testimonial">
	<div class="swiper-container swiper1">
		<div class="swiper-wrapper">
			<?php
			while ( $clients->have_posts() ) {
				$clients->the_post(); ?>
				<div class="swiper-slide">
					<div class="clients-testimonial-wrapper">
						<?php get_template_part( 'template-parts/client/client' ); ?>
					</div>
				</div>
			<?php }
			wp_reset_query();
			?>
		</div>
	</div>
	<div class="swiper-navigation container">
		<div class="swiper-button-prev prev-swiper1"></div>
		<div class="swiper-button-next next-swiper1"></div>
	</div>
</div>


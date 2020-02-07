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


<div class="page-section__customers--client-list">
	<div class="page-section--container client-list container">
		<h2 class="page-section--title">
			<?php echo wp_kses_post( get_theme_mod( "client_{$slug}_title" ) ); ?>
		</h2>
		<div class="client-list__wrapper">
			<?php
			while ( $clients->have_posts() ) {
				$clients->the_post();
				get_template_part( 'template-parts/client/client' );
			}
			wp_reset_query();
			?>
		</div>
	</div>
</div>

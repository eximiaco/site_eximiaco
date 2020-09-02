<?php
/**
 * Page section.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

use Aztec\Helper\PageSection;

global $container;
$page_section = $container->get( PageSection::class );
?>
<div class="page-section--container container">
	<div class="page-section--content">
		<!-- Title -->
		<h2 class="page-section--title">
			<?php echo wp_kses_post( $page_section->get_title() ); ?>
		</h2>

		<!-- Content -->
		<div class="page-section--text">
			<?php echo wp_kses_post( $page_section->get_content() ); ?>
		</div>

		<!-- List -->
		<?php if ( 'customers' === $page_section->get_template() && have_rows( 'items' ) ) : ?>
		<ul class="page-section--list">
			<?php
			while ( have_rows( 'items' ) ) :
				the_row();
				?>
				<li><?php the_sub_field( 'item_text' ); ?></li>
			<?php endwhile; ?>
		</ul>
		<?php endif; ?>

		<!-- Button -->
		<?php
		$url   = get_sub_field( 'button_url' );
		$label = get_sub_field( 'button_label' );

		if ( $label && $url ) :
			?>
			<div class="page-section--action">
				<a href="<?php echo esc_url( $url ); ?>" class="page-section--button button button__bordered">
					<?php echo esc_html( $label ); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>

	<!-- Image -->
	<div class="page-section--image wow fadeIn">
		<?php echo wp_kses_post( $page_section->get_image() ); ?>
	</div>
</div>


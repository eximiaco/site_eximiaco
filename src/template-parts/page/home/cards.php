<?php
/**
 * Cards on homepage
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

if ( empty( get_field( 'cards_title' ) ) )  {
	return;
}
?>

<div class="front-page--home-cards">
	<div class="front-page--home-cards-title wow fadeIn">
		<?php echo wp_kses_post( get_field( 'cards_title' ) ); ?>
	</div>
	<?php if ( have_rows( 'cards_repeater' ) ) : ?>
	<div class="container">
		<div class="home-cards-container">
			<?php while ( have_rows( 'cards_repeater' ) ) :
				the_row();
				$card_image = get_sub_field( 'card_image' );
			?>
			<div class="home-cards-card">
				<div class="home-cards-image">
					<img src="<?php echo esc_url( wp_get_attachment_image_url( $card_image['ID'], 'thumbnail' ) ); ?>">
				</div>
				<div class="home-cards-title">
					<?php the_sub_field( 'card_title' ); ?>
				</div>
				<div class="home-cards-text">
					<?php the_sub_field( 'card_text' ); ?>
				</div>
			</div>
			<?php endwhile; ?>
		</div>
	</div>
	<?php endif; ?>
</div>

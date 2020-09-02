<?php
/**
 * Cards on homepage
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

if ( empty( get_field( 'purpose_title' ) ) )  {
	return;
}
?>

<div class="front-page--purpose container">
	<div class="front-page--purpose-content">
		<div class="front-page--purpose-title wow fadeIn">
			<?php echo wp_kses_post( get_field( 'purpose_title' ) ); ?>
		</div>

		<div class="purpose-image wow fadeIn">
			<?php $purpose_image = get_field( 'purpose_image' ); ?>
			<img src="<?php echo esc_url( wp_get_attachment_image_url( $purpose_image['ID'], 'medium_large' ) ); ?>" alt="Meu trabalho">
		</div>

		<div class="purpose-info">
			<div class="purpose wow fadeIn">
			<?php $icon_class = get_field( 'purpose_icon_1' ); ?>
				<div class="purpose--icon">
					<i class="<?php echo esc_attr( $icon_class ); ?>"></i>
				</div>
				<div class="purpose--content">
					<div class="purpose--title">
					<?php echo wp_kses_post( get_field( 'purpose_title_1' ) ); ?>
					</div>
				<?php echo wp_kses_post( get_field( 'purpose_text_1' ) ); ?>
				</div>
			</div>
			<div class="purpose wow fadeIn">
			<?php $icon_class = get_field( 'purpose_icon_2' ); ?>
				<div class="purpose--icon">
					<i class="<?php echo esc_attr( $icon_class ); ?>"></i>
				</div>
				<div class="purpose--content">
					<div class="purpose--title">
					<?php echo wp_kses_post( get_field( 'purpose_title_2' ) ); ?>
					</div>
				<?php echo wp_kses_post( get_field( 'purpose_text_2' ) ); ?>
				</div>
			</div>
		</div>
	</div>
</div>

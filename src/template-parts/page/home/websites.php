<?php
/**
 * Websites on homepage
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

if ( empty( get_field( 'websites_title' ) ) )  {
	return;
}
?>

<div class="front-page--websites">
	<div class="container container__xs-small-margin">
		<h2 class="websites__title wow fadeIn"><?php echo wp_kses_post( get_field( 'websites_title' ) ); ?></h2>
		<div class="websites">
			<?php
			$websites_tech_logo = get_field( 'websites_logo_1' );
			$websites_ms_logo = get_field( 'websites_logo_2' );
			?>
			<div class="websites__item websites__item--tech">
				<div class="websites__item-header">
					<div class="websites__item-logo">
						<img src="<?php echo esc_url( wp_get_attachment_image_url( $websites_tech_logo['ID'], 'medium_large' ) ); ?>">
					</div>
					<div class="websites__item-description">
						<?php echo wp_kses_post( get_field( 'websites_text_1' ) ); ?>
					</div>
				</div>

				<div class="websites__item-posts">
				<?php
				switch_to_blog( 2 );
				set_query_var( 'posts_per_page', '2');
				get_template_part( 'template-parts/page/home/posts' );
				restore_current_blog();
				?>
				</div>
			</div>

			<div class="websites__item websites__item--ms">
				<div class="websites__item-header">
					<div class="websites__item-logo">
						<img src="<?php echo esc_url( wp_get_attachment_image_url( $websites_ms_logo['ID'], 'medium_large' ) ); ?>">
					</div>
					<div class="websites__item-description">
						<?php echo wp_kses_post( get_field( 'websites_text_2' ) ); ?>
					</div>
				</div>

				<div class="websites__item-posts">
				<?php
				switch_to_blog( 3 );
				set_query_var( 'posts_per_page', '2');
				get_template_part( 'template-parts/page/home/posts' );
				restore_current_blog();
				?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
/**
 * Clients Testimonials on homepage
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

 use Aztec\PostType\Testimonial;

global $container;

$testimonials = $container->get( Testimonial::class )->get_testimonials();

if ( 0 === count( $testimonials ) )  {
	return;
}
?>

<div class="front-page--home-cards">
	<div class="front-page--testimonial container wow fadeIn">
		<div class="swiper-container swiper2">
			<div class="swiper-wrapper">
			<?php
			foreach ( $testimonials as $post ) :
				setup_postdata( $post );
				$photo = get_field( 'testimonial_photo' );
				$logo  = get_field( 'testimonial_logo' );
				?>
				<div class="swiper-slide">
					<div class="testimonial">
						<div class="testimonial--container">
							<div class="testimonial--image">
								<img src="<?php echo esc_html( wp_get_attachment_image_url( $photo['ID'] ) ); ?>" alt="">
							</div>
							<div class="testimonial--content">
								&quot;<?php echo wp_kses_post( get_the_content() ); ?>&quot;
							</div>
							<div class="testimonial--footer">
								<div class="testimonial--company">
									<img src="<?php echo esc_html( wp_get_attachment_image_url( $logo['ID'], 'testimonial-logo' ) ); ?>" alt="">
								</div>
								<div class="testimonial--author">
									<p><?php echo esc_html( get_field( 'testimonial_position' ) ); ?></p>
									<p><?php the_title(); ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
				endforeach;
				wp_reset_postdata();
			?>
			</div>
			<div class="swiper-button-next next-swiper2"></div>
			<div class="swiper-button-prev prev-swiper2"></div>
		</div>
	</div>
</div>

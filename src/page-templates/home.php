<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * Template name: Home
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

use Aztec\Helper\Url;
use Aztec\PostType\Testimonial;

global $container;

$url_helper = $container->get( Aztec\Helper\Url::class );

get_header(); ?>

<main>
	<?php
	while ( have_posts() ) :
		the_post();
		?>
	<?php if ( have_rows( 'slider_hero_repeater' ) ) : ?>
	<div class="slider">
		<div class="slider__wrapper">
			<?php
			$dots = '';
			$count = 1;
			while ( have_rows( 'slider_hero_repeater' ) ) :
				the_row();
				$image = wp_get_attachment_image_src( get_sub_field( 'hero_image' ), 'post-single-banner-lg' );
				?>
				<div class="slider__item <?php 1 === $count ? ' slider__item--active' : ''; ?>" data-order="<?php echo $count; ?>">
					<img class="slider__img" src="<?php echo $image[0]; ?>" alt="" />
					<div class="slider__content">
						<div class="container">
							<h1 class="slider__content-title"><?php the_sub_field( 'hero_title' ); ?></h1>
							<h2 class="slider__content-subtitle"><?php echo preg_replace( '/(.*)\*(.*)\*(.*)/', '$1<strong>$2</strong>$3', get_sub_field( 'hero_subtitle' ) ); ?></h2>
							<div class="slider__content-info">
								<div class="slider__content-txt"><?php the_sub_field( 'hero_text' ); ?></div>
								<?php if ( get_sub_field( 'hero_button_url' ) ) : ?>
									<a href="<?php the_sub_field( 'hero_button_url' ); ?>" class="slider__content-lnk">
										<?php the_sub_field( 'hero_button_label' ); ?>
									</a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			<?php
			$dots .= '<span class="slider__dots" onclick="currentSlide(' . $count . ')"></span>';
			$count++;
			endwhile; ?>
		</div>
		<div class="slider__nav">
			<?php echo $dots; ?>
		</div>
	</div>
	<?php endif; ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'front-page' ); ?>>

		<div class="front-page--websites container">
			<div class="front-page--websites-content">
				<div class="front-page--websites-title wow fadeIn">
					<?php echo wp_kses_post( get_field( 'websites_title' ) ); ?>
				</div>
				<div class="websites-images wow fadeIn">
					<div class="websites-image">
						<div class="websites-box">
							<a href="<?php echo wp_kses_post( get_field( 'websites_link_1' ) ); ?>">
								<?php $websites_image1 = get_field( 'websites_image_1' ); ?>
								<img src="<?php echo esc_url( wp_get_attachment_image_url( $websites_image1['ID'], 'medium_large' ) ); ?>">
								<div class="websites-overlay">
									<?php $websites_logo1 = get_field( 'websites_logo_1' ); ?>
									<div class="websites-logo">
										<img src="<?php echo esc_url( wp_get_attachment_image_url( $websites_logo1['ID'], 'medium_large' ) ); ?>">
									</div>
									<div class="websites-text"><?php echo wp_kses_post( get_field( 'websites_text_1' ) ); ?></div>
								</div>
							</a>
						</div>
					</div>
					<div class="websites-image2">
					<div class="websites-box">
							<a href="<?php echo wp_kses_post( get_field( 'websites_link_2' ) ); ?>">
								<?php $websites_image2 = get_field( 'websites_image_2' ); ?>
								<img src="<?php echo esc_url( wp_get_attachment_image_url( $websites_image2['ID'], 'medium_large' ) ); ?>">
								<div class="websites-overlay">
									<?php $websites_logo2 = get_field( 'websites_logo_2' ); ?>
									<div class="websites-logo">
										<img src="<?php echo esc_url( wp_get_attachment_image_url( $websites_logo2['ID'], 'medium_large' ) ); ?>">
									</div>
									<div class="websites-text"><?php echo wp_kses_post( get_field( 'websites_text_2' ) ); ?></div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="front-page--blog">
			<div class="container container__xs-small-margin">
				<h2 class="front-page--blog-title wow fadeIn"><?php esc_html_e( 'Blog', 'elemarjr' ); ?></h2>

			<?php
				$container->set(
					'template.home.blog', [
						'description' => get_field( 'blog_text' ),
					]
				);
				get_template_part( 'template-parts/page/home/blog' );

			if ( pll_current_language() !== 'en' ) {
				$container->set(
					'template.home.blog', [
						'language'    => 'en',
						'description' => __( 'Last posts in English', 'elemarjr' ),
					]
				);
				get_template_part( 'template-parts/page/home/blog' );
			}
			?>
			</div>
		</div>

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

		<div class="front-page--quote" style="background-image: url(<?php echo esc_url( get_field( 'quote_image' )['url'] ); ?>);">
			<div class="container">
				<div class="wow fadeIn">
					<div class="front-page--quote-content">
						<span class="front-page--quote-icon"><i class="i-quote"></i></span>
						<div><?php echo wp_kses_post( get_field( 'quote' ) ); ?></div>
						<p class="front-page--quote-author">
							<?php echo wp_kses_post( get_field( 'quote-author' ) ); ?><br>
							<?php echo wp_kses_post( get_field( 'quote-job-role' ) ); ?>
						</p>
					</div>
				</div>
			</div>
		</div>

		<?php
		$posts = $container->get( Testimonial::class )->get_testimonials();
		if ( 0 < count( $posts ) ) :
			?>
		<div class="front-page--testimonial container wow fadeIn">
			<div class="front-page--testimonial-header page-header">
				<h5 class="page-header--title page-header--title__small">
					<?php echo esc_html( get_field( 'testimonial_title' ) ); ?>
				</h5>
			</div>

			<div class="swiper-container">
				<div class="swiper-wrapper">
				<?php
				foreach ( $posts as $post ) :
					setup_postdata( $post );
					$photo = get_field( 'testimonial_photo' );
					$logo  = get_field( 'testimonial_logo' );
					?>
					<div class="swiper-slide">
						<div class="testimonial">
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
					<?php
					endforeach;
					wp_reset_postdata();
				?>
				</div>
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			</div>
			<div class="swiper-pagination"></div>
		</div>
		<?php endif; ?>
	</article>
	<?php endwhile; ?>
</main>

<?php get_footer(); ?>

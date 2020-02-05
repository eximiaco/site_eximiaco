<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * Template name: About
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

get_header();

use Aztec\Helper\PageSection;

global $container;

$page_section = $container->get( PageSection::class ); ?>

<main>
	<?php
	while ( have_posts() ) :
		the_post();
		?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'rich-content' ); ?>>

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
		<?php
		while ( have_rows( 'about_repeater' ) ) :
			the_row();
			?>
			<div class="<?php echo esc_attr( $page_section->get_row_classes() ); ?>">
				<?php get_template_part( 'template-parts/page-sections' ); ?>
			</div>

			<?php endwhile; ?>
	</article>
	<?php endwhile; ?>
</main>

<?php get_footer(); ?>

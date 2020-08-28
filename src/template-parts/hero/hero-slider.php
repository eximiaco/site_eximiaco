<?php
/**
 * Hero Slider component.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

 if ( ! have_rows( 'slider_hero_repeater' ) ) {
	return;
 }

 ?>
<div class="slider">
	<div class="slider__wrapper">
		<?php
		$dots = '';
		$count = 1;
		while ( have_rows( 'slider_hero_repeater' ) ) :
			the_row();
			$image = wp_get_attachment_image_src( get_sub_field( 'hero_image' ), 'post-single-banner-lg' );
			?>
			<div class="slider__item <?php 1 === $count ? ' slider__item--active' : ''; ?> slider__item--<?php the_sub_field( 'hero_template' ); ?>" data-order="<?php echo $count; ?>">
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

<?php
/**
 * Quote on homepage
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

if ( empty( get_field( 'quote' ) ) )  {
	return;
}
?>

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

<?php
/**
 * The post list.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

use Aztec\Customize\Newsletter;
use Aztec\Helper\BackgroundImage;

global $container;

/**
 * Newsletter customize object
 *
 * @var Newsletter $spb
 */
$newsletter = $container->get( Newsletter::class );

/**
 * Get the current lang object
 */
$lang = PLL()->curlang;

?>

<?php
	$bg_images = $container->get( BackgroundImage::class )->get_newsletter_bg_images( $newsletter->get_theme_mod_section_id() . '_background' );
?>
<div class="newsletter"
<?php
foreach ( $bg_images as $size => $url ) :
	echo ' data-bg-' . esc_html( $size ) . '="' . esc_url( $url ) . '"';
	endforeach;
?>
>
	<div class="container">
		<h2 class="newsletter--title">
			<?php echo wp_kses_post( get_theme_mod( $newsletter->get_theme_mod_control_id( $lang, 'title' ) ) ); ?>
		</h2>
		<form class="form newsletter--form" method="post" action="<?php echo esc_attr( get_theme_mod( 'newsletter_action' ) ); ?>" target="_blank">
			<input type="hidden" name="u" value="<?php echo esc_attr( get_theme_mod( 'newsletter_u' ) ); ?>">
			<input type="hidden" name="id" value="<?php echo esc_attr( get_theme_mod( 'newsletter_id' ) ); ?>">

			<div class="newsletter--inputs">
				<input type="text"	name="<?php echo esc_attr( get_theme_mod( 'newsletter_name' ) ); ?>" placeholder="<?php esc_attr_e( 'Name', 'elemarjr' ); ?>" class="col-6" required>
				<input type="text"	name="<?php echo esc_attr( get_theme_mod( 'newsletter_surname' ) ); ?>" placeholder="<?php esc_attr_e( 'Surname', 'elemarjr' ); ?>" required>
				<input type="email"	name="<?php echo esc_attr( get_theme_mod( 'newsletter_email' ) ); ?>" placeholder="<?php esc_attr_e( 'Email', 'elemarjr' ); ?>" required>
			</div>

			<h4 class="newsletter--divisortitle"><?php esc_html_e( 'Check the content of your interest', 'elemarjr' ); ?></h4>

			<div class="newsletter--options">
				<?php

					/*
						Multiplica o número de linguas por dois, pois ele possui dois tipos
						de newsletter.
					*/
				$languages_count = count( PLL()->model->get_languages_list() );
				$num_fields      = 2;
				for ( $x = 1; $x <= $languages_count * $num_fields; $x++ ) :
					?>
					<?php if ( ! empty( get_theme_mod( "newsletter_content_{$x}_id" ) ) ) : ?>
						<label for="<?php echo esc_attr( get_theme_mod( "newsletter_content_{$x}_id" ) ); ?>">
							<div class="newsletter--interest">
								<span><?php echo esc_attr( get_theme_mod( "newsletter_content_{$lang->slug}_{$x}_label" ) ); ?></span>
								<input id="<?php echo esc_attr( get_theme_mod( "newsletter_content_{$x}_id" ) ); ?>" name="<?php echo esc_attr( get_theme_mod( "newsletter_content_{$x}_name" ) ); ?>" class="newsletter--check" type="checkbox" value="Y">
								<span class="checkmark"></span>
							</div>
						</label>
					<?php endif; ?>
				<?php endfor; ?>
			</div>

			<p class="newsletter--check-validation-message">
				<?php esc_html_e( 'Select at least one interest', 'elemarjr' ); ?>
			</p>

			<div class="newsletter--actions">
				<input type="submit" class="button button__white" value="<?php esc_attr_e( 'Subscribe', 'elemarjr' ); ?>">
			</div>
		</form>
	</div>
</div>

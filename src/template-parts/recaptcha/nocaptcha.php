<?php
/**
 * Google Captcha.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 1.0.13
 * @version 0.1.0
 */

?>

<input
	type="submit"
	class="g-recaptcha <?php echo esc_attr( get_query_var( 'submit_button_class' ) ); ?>"
	data-sitekey="<?php echo esc_attr( get_theme_mod( 'no_captcha_site_key' ) ); ?>"
	data-callback="<?php echo esc_attr( get_query_var( 'submit_button_callback' ) ); ?>"
	value="<?php echo esc_attr( get_query_var( 'submit_button_text' ) ); ?>"
	id="<?php echo esc_attr( get_query_var( 'submit_button_id', '' ) ); ?>"
	/>

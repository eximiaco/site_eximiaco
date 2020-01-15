<?php
/**
 * Google No Captcha reCaptcha integration
 *
 * @package WordPress
 * @subpackage AztecWpDevEnv
 * @since 1.0.13
 * @version 0.1.0
 */

 namespace Aztec\Integration\ReCaptcha;

 use Aztec\Base;
/**
 * Integrate with Google ReCaptcha
 */
class NoCaptcha extends Base {


	/**
	 * Init.
	 */
	public function init() {
		if ( is_admin() ) {
			return;
		}

		add_action( 'wp_footer', $this->callback( 'footer' ) );
	}

	/**
	 * Start captcha on footer.
	 */
	public function footer() {
		wp_register_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js' );
		wp_enqueue_script( 'recaptcha' );
	}

	/**
	 * Check Google captcha response, returning if the author of submit is a
	 * bot.
	 *
	 * @return bool
	 */
	public function is_bot() {
		if (isset( $_POST['g-recaptcha-response'] )) {
			$recaptcha_secret = get_theme_mod( 'no_captcha_secret_key' );
			$response         = wp_remote_get( 'https://www.google.com/recaptcha/api/siteverify?secret=' . $recaptcha_secret . '&response=' . $_POST['g-recaptcha-response'] );
			$response         = json_decode( $response['body'], true );

			return false == $response['success'];
		} else {
			return true;
		}
	}
}

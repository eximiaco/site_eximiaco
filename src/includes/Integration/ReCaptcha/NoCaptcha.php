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
	 * Init
	 */
	public function init() {
		add_action( 'wp_enqueue_scripts', $this->callback( 'enqueue_script' ) );
	}

	/**
	 * Enqueue Recaptcha script
	 */
	public function enqueue_script() {
		/**
		 * Filters if the Recaptcha script will be enqueued.
		 *
		 * @param bool $enqueue_script It will enqueue Recaptcha. Default false.
		 */
		$enqueue_captcha = apply_filters( 'elemarjr_enqueue_recaptcha', false );
		if( ! $enqueue_captcha ) {
			return;
		}

		$site_key = get_theme_mod( 'no_captcha_site_key' );

		if ( false === $site_key ) {
			return;
		}

		add_filter( 'elemarjr_script_dependencies', $this->callback( 'script_dependencies' ) );
		add_filter( 'elemarjr_script_localize', $this->callback( 'script_localize' ) );

		wp_enqueue_script( 'recaptcha', "https://www.google.com/recaptcha/api.js?render={$site_key}" );
	}

	/**
	 * Add the Recaptcha site key to application script
	 *
	 * @param aray $localize The current script localization data.
	 * @return array The localization data with Recaptcha site key.
	 */
	public function script_localize( $localize ) {
		$localize['recaptcha_site_key'] = get_theme_mod( 'no_captcha_site_key' );
		return $localize;
	}

	/**
	 * Add Recaptcha script as dependency of application script
	 *
	 * @param array $deps The application script dependency array.
	 * @return array The array with recapcha
	 */
	public function script_dependencies( $deps ) {
		$deps[] = 'recaptcha';
		return $deps;
	}

	/**
	 * Check Google captcha response, returning if the author of submit is a
	 * bot.
	 *
	 * @return bool True if is a bot. Otherwise, false.
	 */
	public function is_bot() {
		if ( empty( $_POST['g-recaptcha-response'] ) ) {
			return true;
		}

		$action           = 'form';
		$recaptcha_secret = get_theme_mod( 'no_captcha_secret_key' );
		$token            = sanitize_text_field( wp_unslash( $_POST['g-recaptcha-response'] ) );
		$hostname         = parse_url( home_url(), PHP_URL_HOST );

		$base_url = 'https://www.google.com/recaptcha/api/siteverify';
		$url      = add_query_arg(
			array(
			'secret' => $recaptcha_secret,
			'response' => $token
			), $base_url
		);

		$response = wp_remote_get( $url );

		if ( is_wp_error( $response ) ) {
			return true;
		}

		$data = json_decode( $response['body'], true );

		if ( false === $data['success'] ) {
			return true;
		}

		if ( $hostname !== $data['hostname'] ) {
			return true;
		}

		if ( $action !== $data['action'] ) {
			return true;
		}

		if ( 0.5 > $data['score'] ) {
			return true;
		}

		return false;
	}
}

<?php
/**
 * Style login page.
 *
 * @package Aztec
 */

namespace Aztec\Pages;

use Aztec\Base;

/**
 * Style login page.
 */
class Login extends Base {

	/**
	 * Add hooks.
	 */
	public function init() {
		add_action( 'login_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_filter( 'login_message', array( $this, 'get_logo' ) );
		add_action( 'login_head', array( $this, 'custom_css' ), 5 );
	}

	/**
	 * Enqueue styles.
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( 'elemar-login', get_stylesheet_directory_uri() . '/assets/css/login.css' );
	}

	public function get_logo()
	{
		$logo_url = get_theme_mod('head_logo') ? get_theme_mod('head_logo' ) : esc_url( get_template_directory_uri() . '/assets/images/logo.svg' );
		echo "<a href=\"#\" class=\"logo-header\"><img src=\"{$logo_url}\" alt=\"\" /></a>";
	}

	/**
	 * Add multiples custom_css
	 */
	public function custom_css() {
		echo sprintf( '<style>:root{ --color-primary: %s; --color-secondary: %s; }</style>',
			get_theme_mod('colors_primary'),
			get_theme_mod('colors_secondary')
		);
	}
}

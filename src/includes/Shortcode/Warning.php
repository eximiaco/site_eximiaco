<?php
/**
 * Warning class
 *
 * @package Aztec
 */

namespace Aztec\Shortcode;

use Aztec\Base;

/**
 * Warning class
 */
class Warning extends Base {

	/**
	 * Init.
	 */
	public function init() {
		add_shortcode( 'warning', $this->callback( 'shortcode_warning' ) );
	}

	/**
	 * warning Shortcode.
	 *
	 * @return string
	 */
	public function shortcode_warning() {
		return sprintf( '<img src="%s" />',
    		esc_url( get_template_directory_uri() . '/assets/images/warning.png' )
		);
	}
}

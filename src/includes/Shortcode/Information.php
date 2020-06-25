<?php
/**
 * Information class
 *
 * @package Aztec
 */

namespace Aztec\Shortcode;

use Aztec\Base;

/**
 * Information class
 */
class Information extends Base {

	/**
	 * Init.
	 */
	public function init() {
		add_shortcode( 'information', $this->callback( 'shortcode_information' ) );
	}

	/**
	 * Information Shortcode.
	 *
	 * @return string
	 */
	public function shortcode_information() {
		return sprintf( '<img src="%s" />',
    		esc_url( get_template_directory_uri() . '/assets/images/information.png' )
		);
	}
}

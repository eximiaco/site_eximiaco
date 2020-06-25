<?php
/**
 * Presentation class
 *
 * @package Aztec
 */

namespace Aztec\Shortcode;

use Aztec\Base;

/**
 * Presentation class
 */
class Presentation extends Base {

	/**
	 * Init.
	 */
	public function init() {
		add_shortcode( 'presentation', $this->callback( 'shortcode_presentation' ) );
	}

	/**
	 * Presentation Shortcode.
	 *
	 * @return string
	 */
	public function shortcode_presentation() {
		return sprintf( '<img src="%s" />',
    		esc_url( get_template_directory_uri() . '/assets/images/presentation.png' )
		);
	}
}

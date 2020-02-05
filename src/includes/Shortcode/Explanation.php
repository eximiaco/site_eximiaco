<?php
/**
 * Explanation class
 *
 * @package Aztec
 */

namespace Aztec\Shortcode;

use Aztec\Base;

/**
 * Explanation class
 */
class Explanation extends Base {

	/**
	 * Init.
	 */
	public function init() {
		add_shortcode( 'explanation', $this->callback( 'shortcode_explanation' ) );
	}

	/**
	 * Explanation Shortcode.
	 *
	 * @param  array  $atts Atts.
	 * @param  string $content The content.
	 * @return string
	 */
	public function shortcode_explanation( $atts, $content = null ) {
		return sprintf( '<div class="shortcode-explanation">
			<div class="shortcode-explanation__content">
				<span class="shortcode-explanation__title">%s</span>
				%s
			</div>
		</div>', $atts['title'], $content );
	}
}

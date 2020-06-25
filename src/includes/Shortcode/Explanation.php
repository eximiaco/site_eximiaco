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
		$image = '';
		if ( array_key_exists( 'img', $atts ) ) {
			$image = sprintf( '<img src="%s/assets/images/%s.png" />', get_template_directory_uri(), $atts['img'] );
		}

		return sprintf( '<div class="shortcode-explanation">
			<div class="shortcode-explanation__content">
				<span class="shortcode-explanation__title">%s</span>
				%s
				%s
			</div>
		</div>', $atts['title'], $image, $content );
	}
}

<?php
/**
 * Veja class
 *
 * @package Aztec
 */

namespace Aztec\Shortcode;

use Aztec\Base;

/**
 * Veja class
 */
class Veja extends Base {

	/**
	 * Init.
	 */
	public function init() {
		add_shortcode( 'veja', $this->callback( 'shortcode_veja' ) );
	}

	/**
	 * Veja Shortcode.
	 *
	 * @param  array $atts Atts.
	 * @param  string $content The content.
	 * @return string
	 */
	public function shortcode_veja( $atts, $content = null ) {
		$content = ltrim($content,"</p>");
		$content = rtrim($content,"<p>");

		$html = '</p>
				<div class="shortcode-veja">
					<span class="shortcode-veja__title">
						Veja
					</span>'
					. $content .
				'</div>
				<p>';
		return $html;
	}
}


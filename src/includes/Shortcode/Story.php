<?php
/**
 * Explanation class
 *
 * @package Aztec
 */

namespace Aztec\Shortcode;

use Aztec\Base;

/**
 * Story class
 */
class Story extends Base {

	/**
	 * Init.
	 */
	public function init() {
		add_shortcode( 'story', $this->callback( 'shortcode_story' ) );
	}

	/**
	 * Story Shortcode.
	 *
	 * @param  array  $atts Atts.
	 * @param  string $content The content.
	 * @return string
	 */

	public function shortcode_story( $atts, $content = null ) {

		return sprintf( '<div class="shortcode-story">
			<img src="%s">
			<div class="shortcode-story__content">
				%s
			</div>
		</div>', esc_url( get_template_directory_uri() . '/assets/images/story-quote.png'), $content );
	}
}

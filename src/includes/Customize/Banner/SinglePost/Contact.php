<?php
/**
 * Contact banner class
 *
 * @package Aztec
 */

namespace Aztec\Customize\Banner\SinglePost;

use Aztec\Customize\Banner\Banner;

/**
 * Contact banner class.
 */
class Contact extends Banner {

	/**
	 * Slug name.
	 *
	 * @var string
	 */
	public $slug = 'single_post_banner';

	/**
	 * Get sectiona name.
	 *
	 * @return string
	 */
	public function get_section_name() {
		return __( 'Single post contact banner', 'elemarjr' );
	}
}

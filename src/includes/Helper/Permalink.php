<?php
/**
 * Permalink Helper.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

namespace Aztec\Helper;

/**
 * Permalink helper functions
 */
class Permalink {

	/**
	 * Get permalink languages slug
	 */
	public function get_languages_slug() {
		if ( ! is_plugin_active( 'polylang/polylang.php' ) ) {
			return;
		}
		return PLL()->model->get_languages_list( array( 'fields' => 'slug' ) );
	}

	/**
	 * Get author category permalink
	 *
	 * @param	string $lang_slug lang slug.
	 * @param	string $author_slug author slug.
	 * @param	string $category_slug category slug.
	 */
	public function get_author_category_permalink( $lang_slug, $author_slug, $category_slug ) {
		return get_home_url() . '/' . $lang_slug . '/author/' . $author_slug . '/category/' . $category_slug;
	}
}

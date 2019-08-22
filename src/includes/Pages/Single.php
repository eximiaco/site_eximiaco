<?php
/**
 * Single template class
 *
 * @package Aztec
 */

namespace Aztec\Pages;

use Aztec\Base;

/**
 * Single post template manipulation
 */
class Single extends Base {

	/**
	 * Add hooks
	 */
	public function init() {
		add_filter( 'wp_link_pages_link', $this->callback( 'custom_post_page_link' ), 10, 2 );
		add_filter( 'private_title_format', $this->callback( 'fix_title_format' ) );
		add_filter( 'protected_title_format', $this->callback( 'fix_title_format' ) );
	}

	/**
	 * Customize the post page link to be a button
	 *
	 * @param string $link The page number HTML output.
	 * @param int    $i    Page number for paginated posts' page links.
	 * @return string The link HTML with button class
	 */
	public function custom_post_page_link( $link, $i ) {
		return preg_replace( '/(<a.*href=".*")(.*)/', '$1 class="button"$2', $link );
	}

	/**
	 * Fix title format.
	 *
	 * @return string
	 */
	public function fix_title_format() {
		return '%s';
	}
}

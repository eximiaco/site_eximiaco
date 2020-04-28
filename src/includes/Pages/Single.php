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
		add_filter( 'elemarjr_enqueue_recaptcha', $this->callback( 'enqueue_captcha' ) );
		add_filter( 'wp_kses_allowed_html', $this->callback( 'custom_wpkses_post_tags') , 10, 2 );
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

	/**
	 * Enqueue captcha if is single
	 *
	 * @param bool $enqueue_captcha Enqueue captcha.
	 * @return bool True, if is single. Otherwise, $enqueue_captcha value.
	 */
	public function enqueue_captcha( $enqueue_captcha ) {
		if ( is_single() ) {
			return true;
		}

		return $enqueue_captcha;
	}

	/**
	 * Add iFrame to allowed wp_kses_post tags
	 *
	 * @param array  $tags Allowed tags, attributes, and/or entities.
	 * @param string $context Context to judge allowed tags by. Allowed values are 'post'.
	 *
	 * @return array
	 */
	public function custom_wpkses_post_tags( $tags, $context ) {
		if ( 'post' === $context ) {
			$tags['iframe'] = array(
				'src'             => true,
				'height'          => true,
				'width'           => true,
				'frameborder'     => true,
				'allowfullscreen' => true,
			);
		}

		return $tags;
	}
}

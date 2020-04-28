<?php
/**
 * Head class.
 *
 * @package Aztec
 */

namespace Aztec\Setup;

use Aztec\Base;

/**
 * Manipulate elements inner the head tag
 *
 * Some WordPress native tags are disabled, like feeds, services and post
 * related links.
 */
class Head extends Base {

	/**
	 * Execute hooks
	 */
	public function init() {
		add_theme_support( 'automatic-feed-links' );
		$this->remove_post_related_links();
		$this->remove_generator();

		add_action( 'wp_head', $this->callback( 'profile' ), 1 );
		add_action( 'wp_head', $this->callback( 'viewport' ), 1 );
		add_action( 'wp_head', $this->callback( 'charset' ), 1 );
		add_action( 'wp_head', $this->callback( 'favicons' ), 1 );
		add_action( 'wp_head', $this->callback( 'keywords' ), 1 );
		add_action( 'wp_head', $this->callback( 'author' ), 1 );
		add_action( 'wp_head', $this->callback( 'custom_css' ), 5 );
	}

	/**
	 * Remove RSS feed head links
	 */
	public function remove_feed_links() {
		remove_action( 'wp_head', 'feed_links_extra', 3 );
		remove_action( 'wp_head', 'feed_links', 2 );
	}

	/**
	 * Remove services head links
	 */
	public function remove_services_links() {
		add_filter( 'xmlrpc_enabled', '__return_false' );

		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
	}

	/**
	 * Remove post related links
	 */
	public function remove_post_related_links() {
		remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
		remove_action( 'wp_head', 'rel_canonical' );
		remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
	}

	/**
	 * Remove unecessary generator header tag
	 */
	public function remove_generator() {
		remove_action( 'wp_head', 'wp_generator' );
	}

	/**
	 * Add profile head profile link
	 */
	public function profile() {
		echo '<link rel="profile" href="http://gmpg.org/xfn/11">' . esc_html( PHP_EOL );
	}

	/**
	 * Add vieport meta tag
	 */
	public function viewport() {
		echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">' . esc_html( PHP_EOL );
	}

	/**
	 * Add author meta tag
	 */
	public function author() {
		if ( is_single() ) {
			global $post;
			$author = get_the_author_meta( 'user_nicename', $post->post_author );
			if ( '' != $author ) {
				echo sprintf( '<meta name="author" content="%s" />', $author ) . esc_html( PHP_EOL );
			}
		}
	}

	/**
	 * Add author meta tag
	 */
	public function keywords() {
		if ( is_single() ) {
			global $post;
			$keywords = get_the_tags( $post->ID );
			if ( ! empty( $keywords ) ) {
				$meta_keywords = array();
				foreach ( $keywords as $keyword ) {
					$meta_keywords[] = $keyword->name;
				}
				echo sprintf( '<meta name="keywords" content="%s" />', implode( ', ', $meta_keywords ) ) . esc_html( PHP_EOL );
			}
		}
	}

	/**
	 * Define document charset
	 */
	public function charset() {
		echo sprintf( '<meta charset="%s">', esc_attr( get_bloginfo( 'charset' ) ) ) . esc_html( PHP_EOL );
	}

	/**
	 * Add multiples favicons
	 */
	public function favicons() {
		$path = get_template_directory_uri() . '/assets/images/favicons';

		echo sprintf( '<link rel="apple-touch-icon" sizes="180x180" href="%s">', esc_url( $path . '/apple-touch-icon.png' ) ) . esc_html( PHP_EOL );
		echo sprintf( '<link rel="icon" type="image/png" sizes="32x32" href="%s">', esc_url( $path . '/favicon-32x32.png' ) ) . esc_html( PHP_EOL );
		echo sprintf( '<link rel="icon" type="image/png" sizes="16x16" href="%s">', esc_url( $path . '/favicon-16x16.png' ) ) . esc_html( PHP_EOL );
		echo sprintf( '<link rel="manifest" href="%s">', esc_url( $path . '/site.webmanifest' ) ) . esc_html( PHP_EOL );
		echo sprintf( '<link rel="mask-icon" href="%s">', esc_url( $path . '/safari-pinned-tab.svg' ) ) . esc_html( PHP_EOL );
		echo '<meta name="msapplication-TileColor" content="#da532c">' . esc_html( PHP_EOL );
		echo '<meta name="theme-color" content="#ffffff">' . esc_html( PHP_EOL );
	}

	/**
	 * Add multiples custom_css
	 */
	public function custom_css() {
		echo sprintf(
			'<style>:root{ --color-primary: %s; --color-secondary: %s; --color-link: %s; } .top-header-wrapper{ background-color: rgba(%s, %s) }</style>',
			get_theme_mod( 'colors_primary' ),
			get_theme_mod( 'colors_secondary' ),
			get_theme_mod( 'colors_link' ),
			$this->hex2rgb( get_theme_mod( 'colors_secondary' ) ),
			get_theme_mod( 'colors_opacity' )
		);
	}

	/**
	 * Generate RGB color by HEX
	 *
	 * @param string $hex Hexadecimal color.
	 * @return string $rgb
	 */
	public function hex2rgb( $hex ) {
		$hex = str_replace( '#', '', $hex );

		if (strlen( $hex ) == 3) {
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		} else {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}
		$rgb = "{$r}, {$g}, {$b}";
		return $rgb;
	}
}

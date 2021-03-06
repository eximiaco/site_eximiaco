<?php
/**
 * Template helper class
 *
 * @package Aztec
 */

namespace Aztec\Helper;

/**
 * Manipulate the stylesheets and javascripts
 */
class Template {

	/**
	 * Get the template plart that must be loaded in hero area
	 *
	 * @return string The template. Default: (empty string)
	 */
	public function get_hero_template() {
		if ( is_single() ) {
			return 'single';
		}

		if ( is_page_template() ) {
			return $this->get_template_name();
		}

		if ( is_front_page() ) {
			return 'front-page';
		}

		return 'page';
	}

	/**
	 * Get template name without file path inner the theme and extension
	 *
	 * @param int|\WP_Post $post Optional. Post ID or WP_Post object. Default is global $post.
	 * @return string|false Template name. Returns an empty string when the default page template is in use. Returns false if the post does not exist.
	 */
	public function get_template_name( $post = null ) {
		$slug = get_page_template_slug( $post );

		if ( ! $slug ) {
			return $slug;
		}

		return pathinfo( $slug, PATHINFO_FILENAME );
	}

	/**
	 * Get template header classes
	 *
	 * Add variation `no-hero` if the template is set to hide header hero
	 * content.
	 *
	 * @param  boolean $display_hero Should display the hero.
	 * @return string
	 */
	public function header_classes( $display_hero ) {
		$classes   = array();
		$classes[] = 'site-header';

		if ( ! $display_hero ) {
			$classes[] = 'site-header__no-hero';
		} else {
			$classes[] = 'site-header__parallax';
		}

		return implode( ' ', $classes );
	}
}

<?php
/**
 * Navigation class
 *
 * @package LandAgency
 */

namespace Aztec\Setup;

use Aztec\Base;

/**
 * Manipulate the navigation positions in the theme
 */
class Navigation extends Base {

	/**
	 * Add hooks.
	 */
	public function init() {
		add_action( 'after_setup_theme', $this->callback( 'register_nav_menus' ) );

		add_filter( 'walker_nav_menu_start_el', $this->callback( 'social_walker_nav_menu_start_el' ), 10, 4 );
		add_filter( 'walker_nav_menu_start_el', $this->callback( 'store_walker_nav_menu_start_el' ), 10, 4 );
		add_filter( 'nav_menu_css_class', $this->callback( 'fix_services_custom_post_type_highlight' ), 10, 2 );
		add_filter( 'nav_menu_css_class', $this->callback( 'fix_restricted_area_link_hightlight' ), 10, 2 );
		add_filter( 'nav_menu_css_class', $this->callback( 'fix_thinking_link_highlight' ), 10, 2 );
		add_filter( 'nav_menu_css_class', $this->callback( 'fix_thinking_sub_menu_link_highlight' ), 10, 2 );
	}

	/**
	 * Register theme navigations.
	 */
	public function register_nav_menus() {
		register_nav_menus(
			array(
				'primary' => __( 'Primary', 'elemarjr' ),
				'social' => __( 'Social Menu', 'elemarjr' ),
				'store' => __( 'Store Menu', 'elemarjr'),
			)
		);
	}

	/**
	 * Add social icons to social menu.
	 *
	 * @param  string    $item_output The menu item's starting HTML output.
	 * @param  \WP_Post  $item The current menu item.
	 * @param  int       $depth Depth of menu item. Used for padding.
	 * @param  \stdClass $args An object of wp_nav_menu() arguments.
	 *
	 * @return string
	 */
	public function social_walker_nav_menu_start_el( $item_output, $item, $depth, $args ) {
		if ( 'social' === $args->theme_location ) {
			$icon        = sprintf( '<i class="%s"></i>', $this->social_menu_item_icon( $item->url ) );
			$item_output = str_replace( $args->link_after, "</span>{$icon}", $item_output );
		}

		return $item_output;
	}

	/**
	 * Get social menu icon class name.
	 *
	 * @param  string $url Menu item URL.
	 * @return string
	 */
	private function social_menu_item_icon( $url ) {
		if ( 'mailto:' === substr( $url, 0, 7 ) ) {
			return 'i-mail';
		}

		$home_url = parse_url( home_url( '/' ), PHP_URL_HOST );
		$url      = parse_url( $url, PHP_URL_HOST );
		$url      = preg_replace( '/www\./', '', $url );

		switch ( $url ) {
			case $home_url:
				$icon = 'i-rss';
				break;
			case 'github.com':
				$icon = 'i-github';
				break;
			case 'twitter.com':
				$icon = 'i-twitter';
				break;
			case 'linkedin.com':
				$icon = 'i-linkedin';
				break;
			case 'facebook.com':
				$icon = 'i-facebook';
				break;
			case 'open.spotify.com':
				$icon = 'i-spotify';
				break;
			case 'youtube.com':
				$icon = 'i-youtube';
				break;
			case 'soundcloud.com':
				$icon = 'i-soundcloud';
				break;
			case 'applepodcasts.com':
				$icon = 'i-applepodcasts';
				break;
			case 'deezer.com':
				$icon = 'i-deezer';
				break;
			default:
				$icon = 'i-rss';
				break;
		}

		return $icon;
	}

	/**
	 * Add store icons to store menu.
	 *
	 * @param  string    $item_output The menu item's starting HTML output.
	 * @param  \WP_Post  $item The current menu item.
	 * @param  int       $depth Depth of menu item. Used for padding.
	 * @param  \stdClass $args An object of wp_nav_menu() arguments.
	 *
	 * @return string
	 */
	public function store_walker_nav_menu_start_el( $item_output, $item, $depth, $args ) {
		if ( 'store' === $args->theme_location ) {
			$icon        = sprintf( '<i class="%s"></i>', $this->store_menu_item_icon( $item->url ) );
			$item_output = str_replace( $args->link_after, "</span>{$icon}", $item_output );
		}

		return $item_output;
	}

	/**
	 * Get store menu icon class name.
	 *
	 * @param  string $url Menu item URL.
	 * @return string
	 */
	private function store_menu_item_icon( $url ) {

		$url      = parse_url( $url, PHP_URL_HOST );
		$url      = preg_replace( '/www\./', '', $url );

		switch ( $url ) {
			case 'open.spotify.com':
				$icon = 'i-spotify';
				break;
			case 'soundcloud.com':
				$icon = 'i-soundcloud';
				break;
			case 'applepodcasts.com':
				$icon = 'i-applepodcasts';
				break;
			case 'deezer.com':
				$icon = 'i-deezer';
				break;
			default:
				$icon = 'i-rss';
				break;
		}

		return $icon;
	}

	/**
	 * Check if the current menu item is page for posts.
	 *
	 * @param  \WP_Post $item Current item.
	 * @return boolean
	 */
	private function is_page_for_posts( $item ) {
		return get_option( 'page_for_posts' ) == $item->object_id;
	}

	/**
	 * Remove active class from blog item.
	 *
	 * @param  array $classes All classes from the current item.
	 * @return array
	 */
	private function remove_blog_active_class( $classes ) {
		$key = array_search( 'current-menu-item', $classes );

		if ( false != $key ) {
			unset( $classes[$key] );
		}

		return $classes;
	}

	/**
	 * Add active class from blog item.
	 *
	 * @param  array $classes All classes from the current item.
	 * @return array
	 */
	private function add_blog_active_class( $classes ) {
		$key = array_search( 'current-menu-item', $classes );

		if ( false === $key ) {
			$classes[] = 'current-menu-item';
		}

		return $classes;
	}

	/**
	 * Fix menu hightlight on services custom post type listing.
	 *
	 * @param  array    $classes Current menu classes.
	 * @param  \WP_Post $item    Current menu item.
	 * @return array
	 */
	public function fix_services_custom_post_type_highlight( $classes, $item ) {
		if ( 'service' == get_post_type() ) {
			if ( $this->is_page_for_posts( $item ) ) {
				$classes = $this->remove_blog_active_class( $classes );
			} elseif ( 'page-templates/services.php' == get_page_template_slug( $item->object_id ) ) {
				$classes[] = 'current-menu-item';
			}
		}

		return $classes;
	}

	/**
	 * Fix menu highlight on services custom post type listing.
	 *
	 * @param array    $classes    Current menu classes.
	 * @param \WP_Post $item       Current menu item.
	 * @return array
	 */
	public function fix_thinking_link_highlight( $classes, $item ) {
		$post_types_sub_menus = array( 'blog', 'bliki', 'post' );
		if ( 'Thinking' === $item->title && in_array( get_post_type(), $post_types_sub_menus ) ) {
			$classes = $this->add_blog_active_class( $classes );
		}

		return $classes;
	}

	 /**
	  * Fix menu highlight on services custom post type listing.

	  * @param array    $classes    Current menu classes.
	  * @param \WP_Post $item       Current menu item.
	  * @return array
	  */
	public function fix_thinking_sub_menu_link_highlight( $classes, $item ) {
		if ( 'Blog' === $item->title && 'bliki' === get_post_type() ) {
			$classes = $this->remove_blog_active_class( $classes );
		}
		if ( $this->check_menu_item_post_type( $item, 'bliki', 'Bliki' ) || 'post' == get_post_type() ) {
			$classes = $this->maybe_add_or_remove_active_menu( $classes, $item, 'bliki', 'Bliki' );
		}

		return $classes;
	}

	/**
	 * Maybe add or remove active class from menu.
	 *
	 * @param array    $classes    Current menu classes.
	 * @param \WP_Post $item       Current menu item.
	 * @param string   $post_type  Desired menu post type.
	 * @param string   $menu_title Current menu title.
	 */
	public function maybe_add_or_remove_active_menu( $classes, $item, $post_type, $menu_title ) {
		if ( $menu_title === $item->title ) {
			if ( $post_type === get_post_type() ) {
				$classes = $this->add_blog_active_class( $classes );
			} else {
				$classes = $this->remove_blog_active_class( $classes );
			}
		}

		return $classes;
	}

	/**
	 * Check if the item menu.
	 *
	 * @param \WP_Post $item           Current menu item.
	 * @param string   $post_type      Desired post type.
	 * @param string   $item_title     Desired menu title.
	 * @return bool
	 */
	public function check_menu_item_post_type( $item, $post_type, $item_title ) {
		return ( ( $post_type === get_post_type() ) && $item_title === $item->title );
	}

	/**
	 * Fix menu hightlight on restricted area post.
	 *
	 * @param  array    $classes Current menu classes.
	 * @param  \WP_Post $item    Current menu item.
	 * @return array
	 */
	public function fix_restricted_area_link_hightlight( $classes, $item ) {
		if ( is_single() && 'private' === get_post_status() ) {
			if ( $this->is_page_for_posts( $item ) ) {
				$classes = $this->remove_blog_active_class( $classes );
			} elseif ( 'page-templates/restricted-area.php' == get_page_template_slug( $item->object_id ) ) {
				$classes[] = 'current-menu-item';
			}
		}

		return $classes;
	}
}

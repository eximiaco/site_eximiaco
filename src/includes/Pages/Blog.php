<?php
/**
 * Posts listing pages class
 *
 * @package Aztec
 */

namespace Aztec\Pages;

use Aztec\Base;
use Aztec\Integration\Polylang\Polylang;

/**
 * Posts listing pages features manipulation
 */
class Blog extends Base {

	/**
	 * Add post listing hooks
	 */
	public function init() {
		add_action( 'pre_get_posts', $this->callback( 'limit_posts_per_page' ) );
		add_action( 'template_redirect', $this->callback( 'display_category_nav' ) );

		add_filter( 'elemarjr_display_hero', $this->callback( 'display_hero' ) );
		add_filter( 'elemarjr_display_breadcrumb', $this->callback( 'display_breadcrumb' ) );
		add_filter( 'excerpt_length', $this->callback( 'excerpt_length' ) );
		add_filter( 'excerpt_more', $this->callback( 'excerpt_more' ) );
		add_filter( 'nav_menu_css_class', $this->callback( 'nav_menu_css_class' ), 10, 4 );
		add_filter( 'next_posts_link_attributes', $this->callback( 'nav_link_class' ) );
		add_filter( 'previous_posts_link_attributes', $this->callback( 'nav_link_class' ) );
		add_filter( 'content_save_pre', $this->callback( 'maybe_save_summary' ) );
	}

	/**
	 * Get the ID of the page set in reading settings
	 *
	 * @return int|boolean The page ID in the setting. False, if not set.
	 */
	public function get_id() {
		return (int) get_option( 'page_for_posts', false );
	}

	/**
	 * Get the page id for the current language
	 *
	 * @return int|false|NULL The page id, if exist for the current language.
	 *                        Null, if the current language is not defined yet.
	 *                        False, otherwise.
	 */
	public function get_current_language_id() {
		if ( ! $this->container->get( Polylang::class )->is_active() ) {
			return $this->get_id();
		}

		return pll_get_post( $this->get_id() );
	}

	/**
	 * Get all languages page ids
	 *
	 * @return array|number|false|NULL
	 */
	public function get_pages_id() {
		if ( ! $this->container->get( Polylang::class )->is_active() ) {
			return array();
		}

		$pages_id     = array();
		$main_page_id = $this->get_id();

		if ( $main_page_id ) {
			$languages = PLL()->links->model->get_languages_list();
			foreach ( $languages as $language ) {
				$page_id = pll_get_post( $main_page_id, $language->slug );

				if ( ! empty( $page_id ) ) {
					$pages_id[] = $page_id;
				}
			}
		}

		return $pages_id;
	}

	/**
	 * Show header just in the home of the blog
	 *
	 * @return boolean True, if is the home of the blog. False, otherwise.
	 */
	public function display_hero() {
		return is_front_page() || is_page_template( 'page-templates/about.php' );
	}

	/**
	 * Display breadcrumb.
	 */
	public function display_breadcrumb() {
		return $this->is_post_list();
	}

	/**
	 * Check if is post list.
	 */
	public function is_post_list() {
		return is_home() || is_archive() || is_search() || is_singular( 'post' ) || is_singular( 'bliki' );
	}

	/**
	 * Set to show up to 9 posts every query request
	 *
	 * @param \WP_Query $query WP query.
	 */
	public function limit_posts_per_page( $query ) {
		if ( is_admin() || ! $query->is_main_query() ) {
			return;
		}

		$query->set( 'posts_per_page', 9 );
	}

	/**
	 * Set the blog post listing excerpt length
	 *
	 * @param  int $length The current excerpt length.
	 * @return int
	 */
	public function excerpt_length( $length ) {
		return 20;
	}

	/**
	 * Set the blog post listing excerpt more
	 *
	 * @param  int $more The current excerpt more.
	 * @return string
	 */
	public function excerpt_more( $more ) {
		return ' ...';
	}

	/**
	 * Nav link class.
	 *
	 * @param  string $attr The nav link class.
	 * @return string
	 */
	public function nav_link_class( $attr ) {
		return $attr . ' class="button"';
	}

	/**
	 * Add current menu item classes for all pages related with the blog
	 *
	 * @param array     $classes The CSS classes that are applied to the menu item's `<li>` element.
	 * @param \WP_Post  $item    The current menu item.
	 * @param \stdClass $args    An object of wp_nav_menu() arguments.
	 * @param int       $depth   Depth of menu item. Used for padding.
	 * @return array The CSS classes adding current classes if internal blog page.
	 */
	public function nav_menu_css_class( $classes, $item, $args, $depth ) {
		if ( ! in_array( $item->object_id, $this->get_pages_id() ) ) {
			return $classes;
		}

		if ( ! ( $this->is_post_list() || is_single() ) ) {
			return $classes;
		}

		$classes[] = 'current-menu-item';
		$classes[] = 'current_page_item';
		$classes[] = 'current_page_parent';

		return $classes;
	}

	/**
	 * Store in the container if the category nav will be showed in the request
	 * or not
	 */
	public function display_category_nav() {
		$display_category_nav = apply_filters( 'elemarjr_display_category_nav', true );
		$this->container->set( 'display_category_nav', $display_category_nav );
	}

	/**
	 * Maybe save the summary, depending on display summary flag
	 *
	 * @param string $content Post content.
	 * @return string
	 */
	public function maybe_save_summary( $content ) {

		if ( 'bliki' !== get_post_type() && 'post' !== get_post_type() ) {
			return $content;
		}

		// prevent to save summary twice.
		remove_filter( 'content_save_pre', $this->callback( 'maybe_save_summary' ) );

		$summaries = $this->getSummary( $content, 1 );

		if ( empty( $summaries ) ) {
			$summaries = $this->getSummary( $content, 2 );
		}

		if ( empty( $summaries ) ) {
			return $content;
		}

		$replace_content = $this->get_replace_content( $summaries );

		$content = str_replace( $replace_content['search'], $replace_content['replace'], $content );

		$summaries = $this->clear_summary( $summaries );

		update_post_meta( get_the_ID(), 'post-summary', $summaries );

		return $content;
	}

	/**
	 * Clear summary array
	 *
	 * @param array	$nodes Summary node.
	 * @return array
	 */
	private function &clear_summary( $nodes ) {
		foreach ( $nodes as &$node ) {
			unset( $node['content'] );

			if ( ! empty( $node['children'] ) ) {
				$node['children'] = $this->clear_summary( $node['children'] );
			}
		}

		return $nodes;

	}

	/**
	 * Return str replace array
	 *
	 * @param array	$nodes Summary node.
	 * @param array $return Recursive return.
	 * @return array
	 */
	private function get_replace_content( $nodes, $return = array() ) {
		if ( empty( $return ) ) {
			$return = [
				'search' => array(),
				'replace' => array()
			];
		}

		foreach ( $nodes as $node ) {
			$return['search'][]  = $node['old_content'];
			$return['replace'][] = $node['new_content'];

			if ( ! empty( $node['children'] ) ) {
				$return = $this->get_replace_content( $node['children'], $return );
			}
		}

		return $return;
	}

	/**
	 * Get summary hierarchy array
	 *
	 * @param string $html Partial html.
	 * @param int    $tag_hierarchy H hierarchy to split.
	 * @param array	 $array_content Content array.
	 */
	private function getSummary( $html, $tag_hierarchy, &$array_content = array() ) {

		$open_tag  = sprintf( '<h%s', $tag_hierarchy );
		$close_tag = sprintf( '</h%s>', $tag_hierarchy );

		$nodes = array();

		$html       = strstr( $html, $open_tag );
		$array_html = preg_split( '/' . $open_tag . '/', $html, null, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE );

		foreach ($array_html as $html) {
			$html = $open_tag . $html;

			preg_match_all( "/<h{$tag_hierarchy}(.*?)>(.*?)<\/h{$tag_hierarchy}>/", $html, $match );
			$old_tag = $match[0][0];

			$tag_content = trim( strip_tags( $old_tag ) );
			$id          = sanitize_title( $tag_content ) . '-' . uniqid();

			$new_tag = "{$open_tag} id=\"{$id}\"> {$tag_content} $close_tag";

			$node = [
				'old_content' => $html,
				'new_content' => str_replace( $old_tag, $new_tag, $html ),
				'tag_content' => $tag_content,
				'tag_id' => $id
			];

			if ( 6 > $tag_hierarchy ) {
				$html = str_replace( $close_tag, '', strstr( $html, $close_tag ) );

				$next_tag_hierarchy = $tag_hierarchy + 1;
				$node['children']   = $this->getSummary( $html, $next_tag_hierarchy );
			}

			$nodes[] = $node;
		}

		return $nodes;
	}

	/**
	 * Get summary template part
	 *
	 * @param array $node Summary node.
	 * @return string
	 */
	public function get_summary_item( $node ) {
		set_query_var( 'summary_node', $node );
		return get_template_part( 'template-parts/blog/content-parts/summary-item' );
	}
}

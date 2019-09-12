<?php
/**
 * Bliki custom post type.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

namespace Aztec\PostType;

use Aztec\Base;

/**
 * Manipulate Bliki post type
 */
class Bliki extends Base {

	/**
	 * Add hooks
	 */
	public function init() {
		add_action( 'init', $this->callback( 'register_post_type' ) );
		add_filter( 'wpseo_title', $this->callback( 'remove_asterisk_from_title' ), 10, 3 );
	}

	/**
	 * Register post type
	 */
	public function register_post_type() {
		register_post_type(
			'bliki',
			array(
				'hierarchical' => false,
				'labels' => array(
					'name' => __( 'Bliki', 'elemarjr' ),
					'singular_name' => __( 'Bliki', 'elemarjr' ),
					'add_new' => _x( 'Add New', 'bliki', 'elemarjr' ),
					'add_new_item' => __( 'Add New Bliki', 'elemarjr' ),
					'new_item' => __( 'New Bliki', 'elemarjr' ),
					'edit_item' => __( 'Edit Bliki', 'elemarjr' ),
					'view_item' => __( 'View Bliki', 'elemarjr' ),
					'all_items' => __( 'All Blikis', 'elemarjr' ),
					'search_items' => __( 'Search Bliki', 'elemarjr' ),
					'not_found' => __( 'No blikis found.', 'elemarjr' ),
					'not_found_in_trash' => __( 'No blikis found in Trash.', 'elemarjr' ),
				),
				'rewrite'                => array(
					'slug' => 'bliki'
				),
				'taxonomies' => array( 'category', 'post_tag' ),
				'show_ui' => true,
				'public' => true,
				'has_archive' => true,
				'supports'  => array( 'author', 'title', 'editor', 'thumbnail', 'page-attributes', 'comments' ),
				'menu_icon' => 'dashicons-admin-post',
			)
		);
	}


	/**
	 * Remove asterisk from title.
	 *
	 * @param  string $title The title with asterisk.
	 * @return string
	 */
	public function remove_asterisk_from_title( $title ) {
		return preg_replace( '/\*/', '', $title );
	}

	/**
	 * Get blikis.
	 *
	 * @return \WP_Query
	 */
	public function get_blikis( $paged ) {
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$query = new \WP_Query(
			array(
				'posts_per_page' => 9,
				'post_type' => 'bliki',
				'order' => 'DESC',
				'orderby' => 'modified',
				'paged' => $paged
			)
		);

		return $query;
	}
}

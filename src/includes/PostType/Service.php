<?php
/**
 * Service custom post type.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

namespace Aztec\PostType;

use Aztec\Base;

/**
 * Service custom post type,
 */
class Service extends Base {

	/**
	 * Add hooks
	 */
	public function init() {
		add_action( 'init', $this->callback( 'register_post_type' ) );
		add_filter( 'wpseo_title', $this->callback( 'remove_asterisk_from_title' ) );
	}

	/**
	 * Register post type
	 */
	public function register_post_type() {
		register_post_type(
			'service',
			array(
				'labels'       => array(
					'name'               => __( 'Services', 'elemarjr' ),
					'singular_name'      => __( 'Service', 'elemarjr' ),
					'add_new'            => _x( 'Add New', 'service', 'elemarjr' ),
					'add_new_item'       => __( 'Add New Service', 'elemarjr' ),
					'new_item'           => __( 'New Service', 'elemarjr' ),
					'edit_item'          => __( 'Edit Service', 'elemarjr' ),
					'view_item'          => __( 'View Service', 'elemarjr' ),
					'all_items'          => __( 'All Services', 'elemarjr' ),
					'search_items'       => __( 'Search Services', 'elemarjr' ),
					'not_found'          => __( 'No services found.', 'elemarjr' ),
					'not_found_in_trash' => __( 'No services found in Trash.', 'elemarjr' ),
				),
				'rewrite'                => array(
					'slug' => 'servicos'
				),
				'hierarchical'           => true,
				'query_var'              => true,
				'public'                 => true,
				'publicly_queryable'     => true,
				'show_ui'                => true,
				'supports'               => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
				'menu_icon'              => 'dashicons-hammer',
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
	 * Get all services.
	 *
	 * @return \WP_Query
	 */
	public function get_services() {
		return new \WP_Query(
			array(
				'post_type'      => 'service',
				'order'          => 'ASC',
				'orderby'        => 'menu_order',
				'posts_per_page' => -1,
			)
		);
	}
}

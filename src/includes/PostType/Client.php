<?php
/**
 * Client custom post type.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

namespace Aztec\PostType;

use Aztec\Base;

/**
 * Manipulate Client post type
 */
class Client extends Base {

	/**
	 * Add hooks
	 */
	public function init() {
		add_action( 'init', $this->callback( 'register_post_type' ) );
	}

	/**
	 * Register post type
	 */
	public function register_post_type() {
		if ( get_network()->site_id !== get_current_blog_id() ) {
			return;
		}

		register_post_type(
			'client',
			array(
				'hierarchical' => true,
				'labels' => array(
					'name' => __( 'Our Clients', 'elemarjr' ),
					'singular_name' => __( 'Client', 'elemarjr' ),
					'add_new' => _x( 'Add New', 'client', 'elemarjr' ),
					'add_new_item' => __( 'Add New Client', 'elemarjr' ),
					'new_item' => __( 'New Client', 'elemarjr' ),
					'edit_item' => __( 'Edit Client', 'elemarjr' ),
					'view_item' => __( 'View Client', 'elemarjr' ),
					'all_items' => __( 'All Clients', 'elemarjr' ),
					'search_items' => __( 'Search Clients', 'elemarjr' ),
					'not_found' => __( 'No events found.', 'elemarjr' ),
					'not_found_in_trash' => __( 'No events found in Trash.', 'elemarjr' ),
				),
				'show_ui' => true,
				'supports' => array( 'title', 'thumbnail', 'page-attributes' ),
				'menu_icon' => 'dashicons-groups',
			)
		);
	}

	/**
	 * Get all clients.
	 *
	 * @return array
	 */
	public function get_clients() {
		return new \WP_Query(
			array(
				'post_type' 		=> 'client',
				'orderby'			=> 'menu_order',
				'order'				=> 'ASC',
				'posts_per_page'	=> -1,
			)
		);
	}
}

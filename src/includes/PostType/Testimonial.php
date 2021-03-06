<?php
/**
 * Testimonal custom post type.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

namespace Aztec\PostType;

use Aztec\Base;

/**
 * Manipulate Testimonial post type
 */
class Testimonial extends Base {

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
		register_post_type(
			'testimonial',
			array(
				'hierarchical' => true,
				'labels' => array(
					'name' => __( 'Testimonials', 'elemarjr' ),
					'singular_name' => __( 'Testimonial', 'elemarjr' ),
					'add_new' => _x( 'Add New', 'testimonial', 'elemarjr' ),
					'add_new_item' => __( 'Add New Testimonial', 'elemarjr' ),
					'new_item' => __( 'New Testimonial', 'elemarjr' ),
					'edit_item' => __( 'Edit Testimonial', 'elemarjr' ),
					'view_item' => __( 'View Testimonial', 'elemarjr' ),
					'all_items' => __( 'All Testimonials', 'elemarjr' ),
					'search_items' => __( 'Search Testimonials', 'elemarjr' ),
					'not_found' => __( 'No testimonials found.', 'elemarjr' ),
					'not_found_in_trash' => __( 'No testimonials found in Trash.', 'elemarjr' ),
				),
				'show_ui' => true,
				'supports' => array( 'title', 'editor', 'page-attributes' ),
				'menu_icon' => 'dashicons-format-status',
			)
		);
	}

	/**
	 * Get all testimonials.
	 *
	 * @return \WP_Query
	 */
	public function get_testimonials() {
		$query = new \WP_Query(
			array(
				'post_type' => 'testimonial',
				'order' => 'ASC',
				'orderby' => 'menu_order',
				'posts_per_page' => -1,
			)
		);

		return $query->posts;
	}
}

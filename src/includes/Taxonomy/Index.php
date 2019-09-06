<?php
/**
 * Index taxonomy
 *
 * @package Aztec
 */

namespace Aztec\Taxonomy;

use Aztec\Base;

/**
 * Index taxonomy
 */
class Index extends Base {
	/**
	 * Slug name.
	 *
	 * @var string
	 */
	private $slug = 'index';

	/**
	 * Add hooks.
	 */
	public function init() {
		add_action( 'init', $this->callback( 'register_taxonomy' ) );
	}

	/**
	 * Register taxonomy.
	 */
	public function register_taxonomy() {
		register_taxonomy(
			$this->slug,
			array(
				'post',
				'bliki'
			),
			array(
				'hierarchical' => true,
				'label'        => __( 'Indexes', 'elemarjr' ),
				'labels'       => array(
					'name' => __( 'Indexes', 'elemarjr' ),
					'singular_name'     => __( 'Index', 'elemarjr' ),
					'all_items'         => __( 'All Indexes', 'elemarjr' ),
					'edit_item'         => __( 'Edit Index', 'elemarjr' ),
					'view_item'         => __( 'View Index', 'elemarjr' ),
					'update_item'       => __( 'Update Index', 'elemarjr' ),
					'add_new_item'      => __( 'Add New Index', 'elemarjr' ),
					'new_item_name'     => __( 'New Index Name', 'elemarjr' ),
					'parent_item'       => __( 'Parent Index', 'elemarjr' ),
					'parent_item_colon' => __( 'Parent Index:', 'elemarjr' ),
					'search_items'      => __( 'Search Indexes', 'elemarjr' ),
					'popular_series'    => __( 'Popular Indexes', 'elemarjr' ),
					'not_found'         => __( 'No indexes found.', 'elemarjr' ),
				),
				'public'       => true,
			)
		);
	}

	/**
	 * Get indexes.
	 *
	 * @return array
	 */
	public function get_indexes() {
		return get_terms(
			$this->slug, array(
			'hide_empty' => false,
			)
		);
	}

	/**
	 * Get all posts with index taxonomy.
	 *
	 * @return array
	 */
	public function get_posts() {
		$data    = array();
		$indexes = $this->get_indexes();

		foreach ($indexes as $index) {
			$data[$index->slug]['term']  = $index;
			$data[$index->slug]['query'] = new \WP_Query(
				array(
					'post_status' => 'private',
					'tax_query'   => array(
						array(
							'taxonomy' => $this->slug,
							'field'    => 'term_id',
							'terms'    => $index->term_id,
						),
					),
					'orderby'     => 'menu_order',
					'order'       => 'ASC'
				)
			);
		}

		return $data;
	}
}

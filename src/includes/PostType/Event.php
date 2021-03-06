<?php
/**
 * Event custom post type.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

namespace Aztec\PostType;

use Aztec\Base;

/**
 * Manipulate Event post type
 */
class Event extends Base {

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
			'event',
			array(
				'hierarchical' => true,
				'labels' => array(
					'name' => __( 'Events', 'elemarjr' ),
					'singular_name' => __( 'Event', 'elemarjr' ),
					'add_new' => _x( 'Add New', 'event', 'elemarjr' ),
					'add_new_item' => __( 'Add New Event', 'elemarjr' ),
					'new_item' => __( 'New Event', 'elemarjr' ),
					'edit_item' => __( 'Edit Event', 'elemarjr' ),
					'view_item' => __( 'View Event', 'elemarjr' ),
					'all_items' => __( 'All Events', 'elemarjr' ),
					'search_items' => __( 'Search Events', 'elemarjr' ),
					'not_found' => __( 'No events found.', 'elemarjr' ),
					'not_found_in_trash' => __( 'No events found in Trash.', 'elemarjr' ),
				),
				'show_ui' => true,
				'supports' => array( 'title', 'thumbnail' ),
				'menu_icon' => 'dashicons-calendar-alt',
			)
		);
	}

	/**
	 * Get all events.
	 *
	 * @return array
	 */
	public function get_events() {
		return get_posts(
			array(
			'numberposts' => -1,
			'post_type' => 'event',
			'meta_key'	=> 'event_start',
			'orderby'	=> 'meta_value_num',
			'order'		=> 'DESC',
			)
		);
	}

	/**
	 * Get all events grouped by year from the main site.
	 *
	 * @return array
	 */
	public function get_events_by_year() {
		switch_to_blog( get_network()->site_id );

		$years = array();
		foreach ($this->get_events() as $event) {
			$start = get_field( 'event_start', $event->ID );

			if ( $start ) {
				$year             = date( 'Y', strtotime( $start ) );
				$years[ $year ][] = $event;
			}
		}

		restore_current_blog();

		return $years;
	}
}

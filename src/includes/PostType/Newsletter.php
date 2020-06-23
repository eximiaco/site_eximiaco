<?php
/**
 * Newsletter custom post type.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

namespace Aztec\PostType;

use Aztec\Base;

/**
 * Manipulate Newsletter post type
 */
class Newsletter extends Base {

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
			'newsletter',
			array(
				'labels'              => array(
					'name'            => __( 'Newsletter', 'elemarjr' ),
					'singular_name'   => __( 'Newsletter', 'elemarjr' ),
					'all_items'       => __( 'All Newsletters', 'elemarjr' )
				),
				'show_ui'             => true,
				'has_archive'         => false,
				'exclude_from_search' => true,
				'query_var'           => false,
				'capabilities'        => array( 'create_posts' => 'do_not_allow' ),
				'supports'            => array( 'thumbnail' ),
				'menu_icon'           => 'dashicons-email-alt',
			)
		);
	}

	/**
	 * Get all newsletters.
	 *
	 * @return array
	 */
	public function get_newsletters() {
		return get_posts(
			array(
				'lang' => '',
				'numberposts' => -1,
				'post_type'   => 'newsletter',
				'orderby'	  => 'post_date',
				'order'		  => 'DESC',
			)
		);
	}

	/**
	 * Get all newsletters grouped by year from the main site.
	 *
	 * @return array
	 */
	public function get_newsletters_by_year() {
		switch_to_blog( get_network()->site_id );

		$years = array();
		foreach ( $this->get_newsletters() as $newsletter ) {
			if ( $newsletter->post_date ) {
				$year             = date( 'Y', strtotime( $newsletter->post_date ) );
				$years[ $year ][] = $newsletter;
			}
		}

		restore_current_blog();

		return $years;
	}
}

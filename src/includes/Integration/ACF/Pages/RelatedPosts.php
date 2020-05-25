<?php
/**
 * Create ACF for related posts
 *
 * @package WordPress
 * @subpackage AztecWpDevEnv
 * @since 0.1.0
 * @version 0.1.0
 */

namespace Aztec\Integration\ACF\Pages;

use Aztec\Base;

/**
 * Add custom fields to post
 */
class RelatedPosts extends Base {

	/**
	 * About template location.
	 *
	 * @var array
	 */
	protected $location = array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
		),
	);

	/**
	 * Init on container.
	 */
	public function init() {
		if ( function_exists( 'acf_add_options_page' ) ) {
			add_action( 'acf/include_fields', $this->callback( 'add_about_event_fields' ) );
		}
	}

	/**
	 * Add related posts fields.
	 */
	public function add_about_event_fields() {
		global $wpdb;

		$posts = $wpdb->get_results( "SELECT ID, post_title
			FROM $wpdb->posts
			WHERE post_type = 'post' AND post_status = 'publish'
			ORDER BY post_title ASC
		");

		$related_posts = array( 'default' => __( 'Random', 'elemarjr' ) );

		foreach ( $posts as $post ) {
			$related_posts[ $post->ID ] = $post->post_title;
		}

		acf_add_local_field_group(
			array(
				'key' => 'relatedposts',
				'title' => __( 'Related Posts', 'elemarjr' ),
				'fields' => array(
					array(
						'type' => 'repeater',
						'key' => 'related_posts',
						'name' => 'related_posts',
						'layout' => 'block',
						'min' => 3,
						'max' => 3,
						'sub_fields' => array(
							array(
								'type'		=> 'select',
								'key'		=> 'related_posts_id',
								'name'		=> 'related_posts_id',
								'label'     => __( 'Posts', 'elemarjr' ),
								'choices'	=> $related_posts,
								'default_value' => array (
									0 => 'default',
								),
							),
						)
					)
				),
				'location' => $this->location,
			)
		);
	}
}

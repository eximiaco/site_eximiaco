<?php
/**
 * Create ACF for template
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
class Feature extends Base {

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
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'bliki',
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
	 * Add about events fields.
	 */
	public function add_about_event_fields() {
		acf_add_local_field_group(
			array(
				'key' => 'post_features',
				'title' => __( 'Features', 'elemarjr' ),
				'fields' => array(
					array(
						'type' => 'repeater',
						'key' => 'feature_repeater',
						'name' => 'feature_repeater',
						'layout' => 'block',
						'sub_fields' => array(
							array(
								'type' => 'text',
								'key' => 'feature_site',
								'name' => 'feature_site',
								'label' => __( 'Site', 'elemarjr' ),
								'wrapper' => array(
									'width' => '33.3%',
								),
							),
							array(
								'type' => 'url',
								'key' => 'feature_url',
								'name' => 'feature_url',
								'label' => __( 'URL', 'elemarjr' ),
								'wrapper' => array(
									'width' => '33.3%',
								),
							),
							array(
								'type' => 'text',
								'key' => 'feature_title',
								'name' => 'feature_title',
								'label' => __( 'Title', 'elemarjr' ),
								'wrapper' => array(
									'width' => '33.3%',
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

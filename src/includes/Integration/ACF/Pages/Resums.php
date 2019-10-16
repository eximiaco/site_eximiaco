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
class Resums extends Base {

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
		// Define number of resums.
		$qtd_rows = 3;

		acf_add_local_field_group(
			array(
				'key' => 'resums',
				'title' => __( 'Resums', 'elemarjr' ),
				'fields' => array(
					array(
						'type' => 'repeater',
						'key' => 'resums_repeater',
						'name' => 'resums_repeater',
						'layout' => 'block',
						'min' => $qtd_rows,
						'max' => $qtd_rows,
						'sub_fields' => array(
							array(
								'type' => 'text',
								'key' => 'resum_title',
								'name' => 'resum_title',
								'label' => __( 'Title', 'elemarjr' ),
							),
							array(
								'type' => 'textarea',
								'key' => 'resum_text',
								'name' => 'resum_text',
								'rows' => '3',
								'label' => __( 'Text', 'elemarjr' ),
							),
						)
					)
				),
				'location' => $this->location,
			)
		);
	}
}

<?php
/**
 * Summary class
 *
 * @package WordPress
 * @subpackage AztecWpDevEnv
 * @since 0.1.0
 * @version 0.1.0
 */

namespace Aztec\Integration\ACF\Pages;

use Aztec\Base;

/**
 * Create ACF for post
 */
class Summary extends Base {

	/**
	 * Event post type condition
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
	 * Init.
	 *
	 * @return void
	 */
	public function init() {
		if ( function_exists( 'acf_add_options_page' ) ) {
			add_action( 'acf/include_fields', $this->callback( 'add_summary_fields' ) );
		}
	}

	/**
	 * Add acf fields.
	 *
	 * @return void
	 */
	public function add_summary_fields() {
		acf_add_local_field_group(
			array(
			'key' => 'summary',
			'title' => __( 'Summary', 'elemarjr' ),
			'fields' => array(
				array(
					'type' => 'true_false',
					'key' => 'show_summary',
					'name' => 'show_summary',
					'message' => __( 'Show Summary', 'elemarjr' ),
				),
			),
			 'location' => $this->location,
			)
		);
	}
}

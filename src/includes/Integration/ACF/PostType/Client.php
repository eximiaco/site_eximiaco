<?php
/**
 * Testimonial class
 *
 * @package WordPress
 * @subpackage AztecWpDevEnv
 * @since 0.1.0
 * @version 0.1.0
 */

namespace Aztec\Integration\ACF\PostType;

use Aztec\Base;

/**
 * Create ACF for client post type
 */
class Client extends Base {

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
				'value' => 'client',
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
			add_action( 'acf/include_fields', $this->callback( 'client_fields' ) );
		}
	}

	/**
	 * Add client fields.
	 *
	 * @return void
	 */
	public function client_fields() {
		acf_add_local_field_group(
			array(
			'key' => 'client',
			'title' => __( 'Client', 'elemarjr' ),
			'fields' => array(
				array(
					'type' => 'image',
					'key' => 'client_logo',
					'name' => 'client_logo',
					'label' => __( 'Client Logo', 'elemarjr' ),
				),
				array(
					'type' => 'url',
					'key' => 'client_url',
					'name' => 'client_url',
					'label' => __( 'URL', 'elemarjr' ),
				),
			),
			 'location' => $this->location,
			)
		);
	}
}

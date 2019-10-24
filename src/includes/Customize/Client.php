<?php
/**
 * Client class
 *
 * @package Aztec
 */

namespace Aztec\Customize;

use Aztec\Base;

/**
 * Integrate customize single post banner with the frontend
 */
class Client extends Base {

	/**
	 * Slug name.
	 *
	 * @var string
	 */
	protected $slug = 'client';

	/**
	 * Init.
	 */
	public function init() {
		add_action( 'customize_register', $this->callback( 'customize' ) );
	}

	/**
	 * WP Customize.
	 *
	 * @param \WP_Customize_Manager $wp_customize WP Customize instance.
	 */
	public function customize( \WP_Customize_Manager $wp_customize ) {
		$section_id = $this->get_theme_mod_section_id();

		$wp_customize->add_section(
			$section_id, array(
				'title' => __( 'Our Clients', 'elemarjr' ),
				'priority' => 190,
			)
		);

		foreach ( PLL()->model->get_languages_list() as $lang ) {
			$field_id = $section_id . '_' . $lang->slug . '_title';
			$wp_customize->add_setting(
				$field_id, array(
					'default' => '',
				)
			);
			$wp_customize->add_control(
				$field_id, array(
					/* translators: %s: website locale */
					'label' => sprintf( __( 'Title of "Our Clients" - (%s)', 'elemarjr' ), $lang->locale ),
					'section' => $section_id,
					'type' => 'text',
				)
			);
		}

	}

	/**
	 * Get mod section id.
	 */
	public function get_theme_mod_section_id() {
		return $this->slug;
	}
}

<?php
/**
 * SinglePostBanner class
 *
 * @package Aztec
 */

namespace Aztec\Customize;

use Aztec\Base;

/**
 * Integrate customize single post banner with the frontend
 */
class Colors extends Base {

	/**
	 * Slug name.
	 *
	 * @var string
	 */
	protected $slug = 'colors';

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
			'title' => __( 'Color Scheme', 'elemarjr' ),
			'priority' => 190,
			)
		);

		$wp_customize->add_setting(
			"{$section_id}_primary", array(
			'default' => '',
			)
		);
		$wp_customize->add_control(
			"{$section_id}_primary", array(
			'label' => __( 'Primary Color', 'elemarjr' ),
			'type' => 'color',
			'section' => $section_id,
			)
		);
		$wp_customize->add_setting(
			"{$section_id}_secondary", array(
			'default' => '',
			)
		);
		$wp_customize->add_control(
			"{$section_id}_secondary", array(
			'label' => __( 'Secondary Color', 'elemarjr' ),
			'type' => 'color',
			'section' => $section_id,
			)
		);

		$wp_customize->add_setting(
			"{$section_id}_opacity", array(
			'default' => '',
			)
		);
		$wp_customize->add_control(
			"{$section_id}_opacity", array(
			'label' => __( 'Main menu opacity', 'elemarjr' ),
			'type' => 'range',
			'section' => $section_id,
			'input_attrs' => array(
				'min' => 0,
				'max' => 1,
				'step' => 0.1,
			 ),
			)
		);
	}

	/**
	 * Get mod section id.
	 */
	public function get_theme_mod_section_id() {
		return $this->slug;
	}
}

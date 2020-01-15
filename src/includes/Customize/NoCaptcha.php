<?php
/**
 * NoCaptcha class
 *
 * @package Aztec
 */

namespace Aztec\Customize;

use Aztec\Base;

/**
 * Integrate NoCaptcha to save keys on customize.
 */
class NoCaptcha extends Base {

	/**
	 * Slug name.
	 *
	 * @var string
	 */
	protected $slug = 'no_captcha';

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
				'title' => __( 'NoCaptcha', 'elemarjr' ),
				'priority' => 190,
			)
		);

		// Site key.
		$wp_customize->add_setting(
			"{$section_id}_site_key", array(
				'default' => '',
			)
		);
		$wp_customize->add_control(
			"{$section_id}_site_key", array(
				'label' => __( 'Site Key', 'elemarjr' ),
				'type' => 'text',
				'section' => $section_id,
			)
		);

		// Secret key.
		$wp_customize->add_setting(
			"{$section_id}_secret_key", array(
				'default' => '',
			)
		);
		$wp_customize->add_control(
			"{$section_id}_secret_key", array(
				'label' => __( 'Secret Key', 'elemarjr' ),
				'type' => 'text',
				'section' => $section_id,
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

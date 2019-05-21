<?php
/**
 * SinglePostSocialMedia class
 *
 * @package Aztec
 */

namespace Aztec\Customize;

use Aztec\Base;

/**
 * Integrate customize single post banner with the frontend
 */
class Social extends Base {

	/**
	 * Slug name.
	 *
	 * @var string
	 */
	protected $slug = 'social_media';

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
			'title' => __( 'Social Media', 'elemarjr' ),
			'priority' => 190,
			)
		);

		$wp_customize->add_setting(
			"{$section_id}_twitter", array(
			'default' => '',
			)
		);
		$wp_customize->add_control( "{$section_id}_twitter", array(
			'label' => __( 'Twitter Account' ),
			'type' => 'text',
			'section' => $section_id,
		) );
	}

	/**
	 * Get mod section id.
	 */
	public function get_theme_mod_section_id() {
		return $this->slug;
	}
}

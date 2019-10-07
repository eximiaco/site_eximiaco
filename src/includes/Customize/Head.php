<?php
/**
 * SinglePostBanner class
 *
 * @package Aztec
 */

namespace Aztec\Customize;

use Aztec\Base;
use Aztec\Customize\Control\Editor;
use Aztec\Setup\Thumbnail;
use WP_Customize_Image_Control;

/**
 * Integrate customize single post banner with the frontend
 */
class Head extends Base {

	/**
	 * Slug name.
	 *
	 * @var string
	 */
	protected $slug = 'head';

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
			'title' => __( 'Header', 'elemarjr' ),
			'priority' => 190,
			)
		);

		$setting_id = $this->get_theme_mod_section_id() . '_logo';
		$control_id = $this->get_theme_mod_section_id() . '_logo_control';

		$wp_customize->add_setting(
			$setting_id, array(
			'transport' => 'refresh',
			'height' => 325,
			)
		);
		$wp_customize->add_control(
			new \WP_Customize_Image_Control(
				$wp_customize,
				$control_id,
				array(
					'label'    => sprintf( __( 'Logo', 'elemarjr' ) ),
					'section'  => $section_id,
					'settings' => $setting_id,
				)
			)
		);

		$wp_customize->add_setting(
			"{$section_id}_primary_url", array(
			'default' => '',
			)
		);
		$wp_customize->add_control(
			"{$section_id}_primary_url", array(
			'label' => __( 'Primary Website', 'elemarjr' ),
			'type' => 'text',
			'description' => __( 'Website URL', 'elemarjr' ),
			'section' => $section_id,
			)
		);
		$wp_customize->add_setting(
			"{$section_id}_primary_title", array(
			'default' => '',
			)
		);
		$wp_customize->add_control(
			"{$section_id}_primary_title", array(
			'type' => 'text',
			'description' => __( 'Website Title', 'elemarjr' ),
			'section' => $section_id,
			)
		);

		// Secondary link
		$wp_customize->add_setting(
			"{$section_id}_secondary_url", array(
			'default' => '',
			)
		);
		$wp_customize->add_control(
			"{$section_id}_secondary_url", array(
			'label' => __( 'Secondary Website', 'elemarjr' ),
			'type' => 'text',
			'description' => __( 'Website URL', 'elemarjr' ),
			'section' => $section_id,
			)
		);
		$wp_customize->add_setting(
			"{$section_id}_secondary_title", array(
			'default' => '',
			)
		);
		$wp_customize->add_control(
			"{$section_id}_secondary_title", array(
			'type' => 'text',
			'description' => __( 'Website Title', 'elemarjr' ),
			'section' => $section_id,
			)
		);

		foreach ( PLL()->model->get_languages_list() as $lang ) {
			// CO.
			$title_id = $this->get_theme_mod_control_id( $lang, 'co_divulgation_text' );
			$wp_customize->add_setting(
				$title_id, array(
				'default' => '',
				)
			);
			$wp_customize->add_control(
				$title_id, array(
				'type' => 'text',
				'description' => __( 'Divulgation Exímia CO ', 'elemarjr' ) . " - $lang->locale",
				'section' => $section_id,
				)
			);

			// TECH
			$title_id = $this->get_theme_mod_control_id( $lang, 'tech_divulgation_text' );
			$wp_customize->add_setting(
				$title_id, array(
				'default' => '',
				)
			);
			$wp_customize->add_control(
				$title_id, array(
				'type' => 'text',
				'description' => __( 'Divulgation Exímia Tech ', 'elemarjr' ) . " - $lang->locale",
				'section' => $section_id,
				)
			);

			// MS
			$title_id = $this->get_theme_mod_control_id( $lang, 'ms_divulgation_text' );
			$wp_customize->add_setting(
				$title_id, array(
				'default' => '',
				)
			);
			$wp_customize->add_control(
				$title_id, array(
				'type' => 'text',
				'description' => __( 'Divulgation Exímia MS ', 'elemarjr' ) . " - $lang->locale",
				'section' => $section_id,
				)
			);
		}

		// CO
		$setting_id = $this->get_theme_mod_section_id() . '_co_divulgation_logo';
		$control_id = $setting_id . '_control';

		$wp_customize->add_setting(
			$setting_id, array(
				'default' => '',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				$control_id,
				array(
					'label'      => __( 'Upload CO Divulgation logo', 'elemarjr' ),
					'section'    => $section_id,
					'settings'   => $setting_id,
				)
			)
		);

		// TECH
		$setting_id = $this->get_theme_mod_section_id() . '_tech_divulgation_logo';
		$control_id = $setting_id . '_control';

		$wp_customize->add_setting(
			$setting_id, array(
				'default' => '',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				$control_id,
				array(
					'label'      => __( 'Upload Tech Divulgation logo', 'elemarjr' ),
					'section'    => $section_id,
					'settings'   => $setting_id,
				)
			)
		);

		// MS
		$setting_id = $this->get_theme_mod_section_id() . '_ms_divulgation_logo';
		$control_id = $setting_id . '_control';

		$wp_customize->add_setting(
			$setting_id, array(
				'default' => '',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				$control_id,
				array(
					'label'      => __( 'Upload MS Divulgation logo', 'elemarjr' ),
					'section'    => $section_id,
					'settings'   => $setting_id,
				)
			)
		);
	}

	/**
	 * Get mod section id.
	 */
	public function get_theme_mod_section_id() {
		return $this->slug;
	}

	/**
	 * Get mod control id.
	 *
	 * @param  \PLL_Language $lang Lang instance.
	 * @param  string        $name Control name.
	 */
	public function get_theme_mod_control_id( \PLL_Language $lang, $name ) {
		return $this->get_theme_mod_section_id() . '_' . $lang->slug . '_' . $name;
	}
}

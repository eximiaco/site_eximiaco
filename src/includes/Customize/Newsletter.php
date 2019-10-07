<?php
/**
 * SinglePostBanner class
 *
 * @package Aztec
 */

namespace Aztec\Customize;

use Aztec\Base;
use Aztec\Integration\Polylang\Polylang;
use Aztec\Setup\Thumbnail;
use Aztec\Customize\Control\Editor;

/**
 * Integrate customize single post banner with the frontend
 */
class Newsletter extends Base {

	/**
	 * Slug name.
	 *
	 * @var string
	 */
	protected $slug = 'newsletter';

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
		if ( ! $this->container->get( Polylang::class )->is_active() ) {
			return $wp_customize;
		}

		$section_id = $this->get_theme_mod_section_id();
		$wp_customize->add_section(
			$section_id, array(
			'title' => __( 'Newletter Form', 'elemarjr' ),
			'priority' => 190,
			)
		);

		foreach ( PLL()->model->get_languages_list() as $lang ) {
			$title_id = $this->get_theme_mod_control_id( $lang, 'title' );
			$wp_customize->add_setting(
				$title_id, array(
				'default' => '',
				)
			);
			$wp_customize->add_control(
				new Editor(
					$wp_customize, $title_id, array(
						'label' => __( 'Title', 'elemarjr' ) . " - $lang->locale",
						'section' => $section_id,
						'editor_settings' => array(
							'quicktags' => true,
							'tinymce'   => true,
						)
					)
				)
			);
		}

		$setting_id = $this->get_theme_mod_section_id() . '_background';
		$control_id = $this->get_theme_mod_section_id() . '_background_control';

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
					'label'    => sprintf( __( 'Background', 'elemarjr' ) ),
					'section'  => $section_id,
					'settings' => $setting_id,
				)
			)
		);

		$wp_customize->add_setting(
			"{$section_id}_action", array(
			'default' => '',
			)
		);
		$wp_customize->add_control(
			"{$section_id}_action", array(
			'type' => 'text',
			'label' => __( 'Form action', 'elemarjr' ),
			'description' => __( 'Form action url', 'elemarjr' ),
			'section' => $section_id,
			)
		);

		$wp_customize->add_setting(
			"{$section_id}_u", array(
			'default' => '',
			)
		);
		$wp_customize->add_control(
			"{$section_id}_u", array(
			'type' => 'text',
			'label' => __( 'User ID', 'elemarjr' ),
			'description' => __( 'Mailchimp user identification', 'elemarjr' ),
			'section' => $section_id,
			)
		);

		$wp_customize->add_setting(
			"{$section_id}_form_id", array(
			'default' => '',
			)
		);
		$wp_customize->add_control(
			"{$section_id}_form_id", array(
			'type' => 'text',
			'label' => __( 'Form ID', 'elemarjr' ),
			'description' => __( 'Mailchimp form identification', 'elemarjr' ),
			'section' => $section_id,
			)
		);

		$wp_customize->add_setting(
			"{$section_id}_name", array(
			'default' => '',
			)
		);
		$wp_customize->add_control(
			"{$section_id}_name", array(
			'type' => 'text',
			'label' => __( 'Enter the form input name tag for these fields', 'elemarjr' ),
			'description' => __( 'Field "Name"', 'elemarjr' ),
			'section' => $section_id,
			)
		);

		$wp_customize->add_setting(
			"{$section_id}_surname", array(
			'default' => '',
			)
		);
		$wp_customize->add_control(
			"{$section_id}_surname", array(
			'type' => 'text',
			'description' => __( 'Field "Surname"', 'elemarjr' ),
			'section' => $section_id,
			)
		);

		$wp_customize->add_setting(
			"{$section_id}_email", array(
			'default' => '',
			)
		);
		$wp_customize->add_control(
			"{$section_id}_email", array(
			'type' => 'text',
			'description' => __( 'Field "E-mail"', 'elemarjr' ),
			'section' => $section_id,
			)
		);

		$languages_list = PLL()->model->get_languages_list();

		/*
			Multiplica o número de linguas por dois, pois ele possui dois tipos
			de newsletter.
		*/
		$languages_count = count( $languages_list );
		$num_fields      = 2;

		for ( $x=1; $x <= ( $languages_count * $num_fields ); $x++ ) {

			$y = true;
			foreach ( $languages_list as $lang ) {
				$wp_customize->add_setting(
					"{$section_id}_content_{$lang->slug}_{$x}_label", array(
					'default' => '',
					)
				);
				$wp_customize->add_control(
					"{$section_id}_content_{$lang->slug}_{$x}_label", array(
					'type' => 'text',
					'label' => ( $y ? __( 'Custom content field', 'elemarjr' ) . " ($x)" : '' ),
					'description' =>  __( 'Field Label', 'elemarjr' ) . " $lang->locale",
					'section' => $section_id,
					)
				);
				$y = false;
			}

			$wp_customize->add_setting(
				"{$section_id}_content_{$x}_id", array(
				'default' => '',
				)
			);
			$wp_customize->add_control(
				"{$section_id}_content_{$x}_id", array(
				'type' => 'text',
				'description' => __( 'Field ID', 'elemarjr' ),
				'section' => $section_id,
				)
			);

			$wp_customize->add_setting(
				"{$section_id}_content_{$x}_name", array(
				'default' => '',
				)
			);
			$wp_customize->add_control(
				"{$section_id}_content_{$x}_name", array(
				'type' => 'text',
				'description' => __( 'Field Name', 'elemarjr' ),
				'section' => $section_id,
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

	/**
	 * Get mod control id.
	 *
	 * @param  \PLL_Language $lang Lang instance.
	 * @param  string        $name Control name.
	 */
	public function get_theme_mod_control_id( \PLL_Language $lang, $name ) {
		return $this->get_theme_mod_section_id() . '_' . $lang->slug . '_' . $name;
	}

	/**
	 * Get mod setting id.
	 *
	 * @param  \PLL_Language $lang Lang instance.
	 * @param  string        $name Control name.
	 */
	public function get_theme_mod_setting_id( \PLL_Language $lang, $name ) {
		return $this->get_theme_mod_section_id() . '_' . $lang->slug . '_setting_' . $name;
	}

	/**
	 * Get background image.
	 *
	 * @param  string $lang The language name.
	 * @return array
	 */
	public function get_background_images( $lang ) {
		$bg_url      = get_theme_mod( $this->get_theme_mod_control_id( $lang, 'background' ) );
		$bg_id       = attachment_url_to_postid( $bg_url );
		$image_sizes = $this->container->get( Thumbnail::class )->post_single_banner_image_sizes;
		$images_urls = array();

		foreach ( $image_sizes as $size ) {
			$images_urls[ $size['size'] ] = wp_get_attachment_image_url( $bg_id, $size['name'] );
		}

		return $images_urls;
	}
}

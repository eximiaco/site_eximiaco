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
use Aztec\Helper\PageSection;

/**
 * Add custom fields to about template.
 */
class About extends Base {

	/**
	 * About template location
	 *
	 * @var array
	 */
	protected $location = array(
		array(
			array(
				'param'    => 'post_template',
				'operator' => '==',
				'value'    => 'page-templates/about.php',
			),
		),
	);

	/**
	 * Default template logic condition.
	 *
	 * @var array
	 */
	protected $default = array(
		'field'    => 'template',
		'operator' => '==',
		'value'    => 'default',
	);

	/**
	 * Customers template logic condition.
	 *
	 * @var array
	 */
	protected $customers = array(
		'field'    => 'template',
		'operator' => '==',
		'value'    => 'customers',
	);

	/**
	 * Section template.
	 *
	 * @var \Aztec\Helper\PageSection
	 */
	private $page_section;

	/**
	 * Init on container
	 */
	public function init() {
		if ( function_exists( 'acf_add_options_page' ) ) {
			add_action( 'acf/include_fields', $this->callback( 'add_hero_fields' ) );
			add_action( 'acf/include_fields', $this->callback( 'body_lines' ) );
		}

		$this->page_section = $this->container->get( PageSection::class );
	}

	/**
	 * The repeater to create the body lines
	 */
	public function body_lines() {
		acf_add_local_field_group(
			array(
			'key'            => 'body_lines',
			'title'          => __( 'Page sections', 'elemarjr' ),
			'hide_on_screen' => array( 'the_content' ),
			'fields'         => array(
				array(
					'type'       => 'repeater',
					'key'        => 'about_repeater',
					'name'       => 'about_repeater',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'type'          => 'select',
							'key'           => 'template',
							'label'         => __( 'Template', 'elemarjr' ),
							'name'          => 'template',
							'required'      => true,
							'choices'       => array (
								'default'   => __( 'Default', 'elemarjr' ),
								'customers' => __( 'Customers', 'elemarjr' ),
								'mvp'       => __( 'MVP', 'elemarjr' ),
							),
							'default_value' => array (
								0 => 'default',
							),
						),
						$this->page_section->add_title_field(),
						$this->page_section->add_content_field(),
						$this->page_section->add_image_field(),
						$this->page_section->add_image_position_field(),
						$this->page_section->add_image_align_field( $this->default ),
						$this->page_section->add_color_scheme_field(),
						$this->page_section->add_padding_field(),
						array (
							'type'              => 'repeater',
							'key'               => 'items',
							'label'             => __( 'Items', 'elemarjr' ),
							'name'              => 'items',
							'conditional_logic' => array (
								array (
									$this->customers,
								),
							),
							'layout'            => 'table',
							'sub_fields'        => array (
								array (
									'type'  => 'text',
									'key'   => 'item_text',
									'label' => __( 'Item', 'elemarjr' ),
									'name'  => 'item_text',
								),
							),
						),
						$this->page_section->add_button_label_field(),
						$this->page_section->add_button_url_field(),
					)
				),
			 ),
			 'location'          => $this->location,
			)
		);
	}

	/**
	 * Add Hero custom fields
	 */
	public function add_hero_fields() {
		acf_add_local_field_group(
			array(
			'key'            => 'about_hero',
			'title'          => __( 'Hero', 'elemarjr' ),
			'hide_on_screen' => array( 'the_content' ),
			'fields'         => array(
				array(
					'type'  => 'wysiwyg',
					'key'   => 'hero_text',
					'name'  => 'hero_text',
					'label' => __( 'Text', 'elemarjr' ),
				),
			 ),
			 'location'      => $this->location,
			)
		);
	}
}

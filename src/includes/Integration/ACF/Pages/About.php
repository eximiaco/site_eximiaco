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
			add_action( 'acf/include_fields', $this->callback( 'add_slider_hero_about' ) );
			add_action( 'acf/include_fields', $this->callback( 'body_lines' ) );
		}

		$this->page_section = $this->container->get( PageSection::class );
	}

	/**
	 * Add Slider Hero custom fields
	 */
	public function add_slider_hero_about() {
		add_filter( 'elemarjr_display_hero', false );
		acf_add_local_field_group(
			array(
				'key'            => 'about_slider_hero',
				'title'          => __( 'Slider hero', 'elemarjr' ),
				'hide_on_screen' => array( 'the_content' ),
				'fields'         => array(
					array(
						'type'       => 'repeater',
						'key'        => 'slider_hero_repeater',
						'name'       => 'slider_hero_repeater',
						'layout'     => 'block',
						'sub_fields' => array(
							array(
								'type'         => 'text',
								'key'          => 'hero_title',
								'name'         => 'hero_title',
								'label'        => __( 'Title', 'elemarjr' ),
							),
							array(
								'type'         => 'text',
								'key'          => 'hero_subtitles',
								'name'         => 'hero_subtitle',
								'label'        => __( 'Sub-Title', 'elemarjr' ),
								'instructions' => __( 'Use * to bold', 'elemarjr' )
							),
							array(
								'type'  => 'wysiwyg',
								'key'   => 'hero_text',
								'name'  => 'hero_text',
								'label' => __( 'Text', 'elemarjr' ),
							),
							array(
								'type'          => 'image',
								'key'           => 'hero_image',
								'name'          => 'hero_image',
								'label'         => __( 'Image', 'elemarjr' ),
								'return_format' => 'id,'
							),
							array (
								'type'    => 'text',
								'label'   => __( 'Button label', 'elemarjr' ),
								'key'     => 'hero_button_label',
								'name'    => 'hero_button_label',
								'wrapper' => array (
									'width' => '50%',
								)
							),
							array (
								'type'    => 'url',
								'label'   => __( 'Button URL', 'elemarjr' ),
								'key'     => 'hero_button_url',
								'name'    => 'hero_button_url',
								'wrapper' => array (
									'width' => '50%',
								),
							),
						)
					),
				),
				'location' => $this->location,
			)
		);
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
							'type'		=> 'select',
							'label'		=> __( 'Template', 'elemarjr' ),
							'key'		=> 'templates',
							'name'		=> 'templates',
							'required'	=> true,
							'choices'	=> array (
								'default'		=> __( 'Default', 'elemarjr' ),
								'customers'		=> __( 'Customers', 'elemarjr' ),
								'mvp'			=> __( 'MVP', 'elemarjr' ),
								'experience'	=> __( 'Experience', 'elemarjr' ),
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
}

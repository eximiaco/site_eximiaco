<?php
/**
 * Section template
 *
 * @package Aztec
 */

namespace Aztec\Helper;

use Aztec\Base;

/**
 * Section template
 */
class PageSection extends Base {

	/**
	 * Add title field.
	 *
	 * @return array
	 */
	public function add_title_field() {
		return array(
			'type'         => 'text',
			'key'          => 'title',
			'name'         => 'title',
			'label'        => __( 'Title', 'elemarjr' ),
			'instructions' => __( 'Use * to bold', 'elemarjr' )
		);
	}

	/**
	 * Add content field.
	 *
	 * @return array
	 */
	public function add_content_field() {
		return array(
			'type'  => 'wysiwyg',
			'key'   => 'text',
			'name'  => 'text',
			'label' => __( 'Text', 'elemarjr' ),
		);
	}

	/**
	 * Add image field.
	 *
	 * @return array
	 */
	public function add_image_field() {
		return array(
			'type'          => 'image',
			'key'           => 'image',
			'name'          => 'image',
			'label'         => __( 'Image', 'elemarjr' ),
			'return_format' => 'id,'
		);
	}

	/**
	 * Add image position field.
	 *
	 * @return array
	 */
	public function add_image_position_field() {
		return array(
			'type'    => 'radio',
			'key'     => 'image_position',
			'name'    => 'image_position',
			'label'   => __( 'Image Position', 'elemarjr' ),
			'choices' => array(
				'left'  => __( 'Left', 'elemarjr' ),
				'right' => __( 'Right', 'elemarjr' ),
			)
		);
	}

	/**
	 * Add image align field.
	 *
	 * @param  array $conditional Conditional logic array.
	 * @return array
	 */
	public function add_image_align_field( $conditional = array() ) {
		return array(
			'type'    => 'radio',
			'key'     => 'image_align',
			'name'    => 'image_align',
			'label'   => __( 'Image Align', 'elemarjr' ),
			'choices' => array(
				'none'         => __( 'None', 'elemarjr' ),
				'top'          => __( 'Overlap top', 'elemarjr' ),
				'stick-top'    => __( 'Stick on top', 'elemarjr' ),
				'stick-bottom' => __( 'Stick on bottom', 'elemarjr' ),
				'bottom'       => __( 'Overlap bottom', 'elemarjr' ),
			),
			'conditional_logic' => array (
				$conditional
			),
		);
	}

	/**
	 * Add button label field.
	 *
	 * @return array
	 */
	public function add_button_label_field() {
		return array (
			'type'    => 'text',
			'key'     => 'button_label',
			'label'   => __( 'Button label', 'elemarjr' ),
			'name'    => 'button_label',
			'wrapper' => array (
				'width' => '50%',
			)
		);
	}

	/**
	 * Add button URL field.
	 *
	 * @return array
	 */
	public function add_button_url_field() {
		return array (
			'key'     => 'button_url',
			'label'   => __( 'Button URL', 'elemarjr' ),
			'name'    => 'button_url',
			'type'    => 'url',
			'wrapper' => array (
				'width' => '50%',
			),
		);
	}

	/**
	 * Add color scheme field.
	 *
	 * @return array
	 */
	public function add_color_scheme_field() {
		return array(
			'type'    => 'radio',
			'key'     => 'color',
			'name'    => 'color',
			'label'   => __( 'Color Scheme', 'elemarjr' ),
			'choices' => array(
				'white' => __( 'Background White and Title Black', 'elemarjr' ),
				'light' => __( 'Background Gray and Title Black', 'elemarjr' ),
				'dark'  => __( 'Background Black and Title White', 'elemarjr' ),
				'dusky' => __( 'Background Dusky and Title White', 'elemarjr' ),
				'darken' => __( 'Background Dark and Title White', 'elemarjr' ),
			)
		);
	}

	/**
	 * Get row classes.
	 */
	public function get_row_classes() {
		$classes   = array();
		$classes[] = 'page-section';

		$this->get_template_class( $classes );
		$this->get_color_scheme_class( $classes );
		$this->get_image_align_class( $classes );
		$this->get_image_position_class( $classes );

		return implode( ' ', $classes );
	}

	/**
	 * Get color scheme classes.
	 *
	 * @param  array   $classes Classes array.
	 * @param  boolean $color_scheme Color scheme.
	 * @return void
	 */
	private function get_color_scheme_class( &$classes, $color_scheme = false ) {
		if ( false === $color_scheme ) {
			$color_scheme = $this->get_field( 'color' );
		}

		if ( 'white' !== $color_scheme ) {
			switch ( $color_scheme ) {
				case 'light':
					$classes[] = 'page-section__light';
					break;
				case 'dark':
					$classes[] = 'page-section__dark';
					break;
				case 'dusky':
					$classes[] = 'page-section__dusky';
					break;
				case 'darken':
					$classes[] = 'page-section__darken';
					break;
			}
		}
	}

	/**
	 * Get template classes.
	 *
	 * @param  array $classes Classes array.
	 * @return void
	 */
	private function get_template_class( &$classes ) {
		$classes[] = 'page-section__' . $this->get_field( 'template' )[0];
	}

	/**
	 * Add image align classes.
	 *
	 * For MVP template the align will be always bottom
	 *
	 * @param  array $classes Classes array.
	 * @return void
	 */
	private function get_image_align_class( &$classes ) {
		$align = $this->get_field( 'image_align' );

		if ( 'mvp' === $this->get_field( 'template' ) ) {
			$align = 'bottom';
		}

		if ( $align !== 'none' ) {
			$classes[] = 'page-section__image-' . $align;
		}
	}

	/**
	 * Add image position classes.
	 *
	 * @param  array   $classes Classes array.
	 * @param  boolean $image_position Image invert position.
	 * @return void
	 */
	private function get_image_position_class( &$classes, $image_position = false ) {
		if ( false === $image_position ) {
			$image_position = $this->get_field( 'image_position' );
		}

		if ( 'left' == $image_position ) {
			$classes[] = 'page-section__invert';
		}
	}

	/**
	 * Get ACF custom field or sub field.
	 *
	 * @param  string $name The name of the field.
	 * @return mixed
	 */
	private function get_field( $name ) {
		return get_sub_field( $name ) ? get_sub_field( $name ) : get_field( $name );
	}

	/**
	 * Get the section title
	 *
	 * @return string The the section title.
	 */
	public function get_title() {
		$title = $this->get_field( 'title' );

		if ( $title ) {
			$text_helper = $this->container->get( Text::class );

			return $text_helper->asterisk_to_strong( $title );
		}

		return get_the_title();
	}

	/**
	 * Get the section content
	 *
	 * @return string The the section content.
	 */
	public function get_content() {
		return $this->get_field( 'text' ) ? $this->get_field( 'text' ) : get_the_content();
	}

	/**
	 * Get the section image
	 *
	 * @return string The the section image.
	 */
	public function get_image() {
		return wp_get_attachment_image( $this->get_field( 'image' ), 'full' );
	}

}

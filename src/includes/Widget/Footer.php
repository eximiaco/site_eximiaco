<?php
/**
 * Widgets Footer
 *
 * @package Aztec
 */

namespace Aztec\Widget;

use Aztec\Base;

/**
 * Init Widgets Footer
 */
class Footer extends Base {

	/**
	 * Execute hooks
	 */
	public function init() {
		add_action( 'widgets_init', $this->callback( 'widgets_footer_init' ) );
	}

	/**
	 * Register widget to show site information in a footer
	 */
	public function widgets_footer_init() {
		// Widgets footer first area.
		register_sidebar(
			array(
				'name'          => __( 'Footer first area', 'elemarjr' ),
				'description'   => __( 'Content showing in first area of footer page', 'elemarjr' ),
				'id'            => 'widgets_area_footer_1',
				'before_widget' => '<div class="info__img">',
				'after_widget'  => '</div>',
				'before_title'  => '',
				'after_title'   => '',
			)
		);

		// Widgets footer second area.
		register_sidebar(
			array(
				'name'          => __( 'Footer second area', 'elemarjr' ),
				'description'   => __( 'Content showing in second area of footer page', 'elemarjr' ),
				'id'            => 'widgets_area_footer_2',
				'before_widget' => '<div class="info__schedule">',
				'after_widget'  => '</div>',
				'before_title'  => '',
				'after_title'   => '',
			)
		);

		// Widgets footer third area.
		register_sidebar(
			array(
				'name'          => __( 'Footer third area', 'elemarjr' ),
				'description'   => __( 'Content showing in third area of footer page', 'elemarjr' ),
				'id'            => 'widgets_area_footer_3',
				'before_widget' => '<div class="info__thinking">',
				'after_widget'  => '</div>',
				'before_title'  => '',
				'after_title'   => '',
			)
		);

		// Widgets footer fourth area.
		register_sidebar(
			array(
				'name'          => __( 'Footer fourth area', 'elemarjr' ),
				'description'   => __( 'Content showing in fourth area of footer page', 'elemarjr' ),
				'id'            => 'widgets_area_footer_4',
				'before_widget' => '<div class="info__contact">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="info__title">',
				'after_title'   => '</div>',
			)
		);
	}
}

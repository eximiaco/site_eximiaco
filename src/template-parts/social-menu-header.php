<?php
/**
 * Social media menu header.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

wp_nav_menu(
	array(
		'theme_location' => 'social_header',
		'menu_id'        => 'social-menu-header',
		'menu_class'     => 'social-navegation',
		'depth'          => 1,
		'link_before'    => '<span class="screen-reader-text">',
		'link_after'     => '</span>',
	)
);

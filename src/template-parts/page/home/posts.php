<?php
/**
 * Latest posts on homepage
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

use Aztec\Helper\Url;

global $container;

$posts_per_page = get_query_var('posts_per_page');
$blog_id        = get_option( 'page_for_posts' );
$query_args     = [
	'posts_per_page' => $posts_per_page,
	'post_status'    => 'publish',
];
$url_helper   = new Url();
$see_more_url = '';

if ( '' === $see_more_url ) {
	$see_more_url = get_permalink( $blog_id );
}

$query = new WP_Query( $query_args );

$container->set( 'post_list.query', $query );
$container->set( 'post_list.extra_class', 'front-page--blog--list' );
get_template_part( 'template-parts/blog/post-list' );

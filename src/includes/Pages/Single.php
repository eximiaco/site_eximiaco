<?php
/**
 * Single template class
 *
 * @package Aztec
 */

namespace Aztec\Pages;

use Aztec\Base;

/**
 * Single post template manipulation
 */
class Single extends Base {

	/**
	 * Add hooks
	 */
	public function init() {
		add_filter( 'wp_link_pages_link', $this->callback( 'custom_post_page_link' ), 10, 2 );
		add_filter( 'private_title_format', $this->callback( 'fix_title_format' ) );
		add_filter( 'protected_title_format', $this->callback( 'fix_title_format' ) );
		add_filter( 'elemarjr_enqueue_recaptcha', $this->callback( 'enqueue_captcha' ) );
		add_filter( 'wp_kses_allowed_html', $this->callback( 'custom_wpkses_post_tags') , 10, 2 );

		// List related posts after post single.
		add_action( 'get_related_posts', $this->callback( 'get_related_posts' ) );
	}

	/**
	 * Customize the post page link to be a button
	 *
	 * @param string $link The page number HTML output.
	 * @param int    $i    Page number for paginated posts' page links.
	 * @return string The link HTML with button class
	 */
	public function custom_post_page_link( $link, $i ) {
		return preg_replace( '/(<a.*href=".*")(.*)/', '$1 class="button"$2', $link );
	}

	/**
	 * Fix title format.
	 *
	 * @return string
	 */
	public function fix_title_format() {
		return '%s';
	}

	/**
	 * Enqueue captcha if is single
	 *
	 * @param bool $enqueue_captcha Enqueue captcha.
	 * @return bool True, if is single. Otherwise, $enqueue_captcha value.
	 */
	public function enqueue_captcha( $enqueue_captcha ) {
		if ( is_single() ) {
			return true;
		}

		return $enqueue_captcha;
	}

	/**
	 * Add iFrame to allowed wp_kses_post tags
	 *
	 * @param array  $tags Allowed tags, attributes, and/or entities.
	 * @param string $context Context to judge allowed tags by. Allowed values are 'post'.
	 *
	 * @return array
	 */
	public function custom_wpkses_post_tags( $tags, $context ) {
		if ( 'post' === $context ) {
			$tags['iframe'] = array(
				'src'             => true,
				'height'          => true,
				'width'           => true,
				'frameborder'     => true,
				'allowfullscreen' => true,
			);
		}

		return $tags;
	}

	/**
	 * Return the related posts in the current post.
	 */
	public function get_related_posts() {
		global $post;

		// Define default params
		$args          = array(
			'numberposts'  => 3,
			'post__not_in' => array( $post->ID ),
			'orderby'      => 'RAND',
		);
		$ids           = array();
		$related_posts = array();

		// Check if have related posts defined
		if ( have_rows( 'related_posts' ) ) {
			while ( have_rows( 'related_posts' ) ) {
				the_row();
				if ( ! empty( get_sub_field( 'related_posts_id' ) ) && 'default' !== get_sub_field( 'related_posts_id' ) ) {
					$ids[] = (int) get_sub_field( 'related_posts_id' );
				}
			}
			if ( 0 !== count( $ids ) ) {
				$args['post__in'] = $ids;
				$related_posts = get_posts( $args );
			}
		}


		// If no have 3 posts selected in related posts
		if ( 3 !== count( $related_posts ) ) {
			$ids[] = $post->ID;
			$args  = array(
				'numberposts'  => ( 3 - count( $related_posts ) ),
				'post__not_in' => $ids,
				'orderby'      => 'rand',
				'order'        => 'ASC',
				'category__in' => wp_get_post_categories( $post->ID )
			);
			$related_posts = array_merge( $related_posts, get_posts( $args ) );
		}

		if ( ! empty( $related_posts ) ) {
			set_query_var( 'related_posts', $related_posts );
			get_template_part( 'template-parts/blog/single/related-posts' );
		}

		wp_reset_postdata();
	}
}

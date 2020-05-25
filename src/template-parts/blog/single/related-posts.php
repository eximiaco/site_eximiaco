<?php
/**
 * Template part for related posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aztecs
 */

$related_posts = get_query_var( 'related_posts' );

if ( empty( $related_posts ) ) {
	return;
}
global $post;
?>


<div class="post-list post-list--related">
	<h3 class="post-list--related-title"><i class="i-arrow-right"></i> <?php esc_attr_e( 'You might also like', 'elemarjr' ); ?></h3>

	<div class="post-list__loading">
		<?php esc_html_e( 'Loading posts...', 'elemarjr' ); ?>
	</div>
	<div class="cards-list <?php echo esc_attr( $extra_class ); ?>">
		<div class="cards-list__wrapper">
			<?php
			foreach ( $related_posts as $post ) :
				// Setup $post data to related content.
				setup_postdata( $post );
				$title   = apply_filters( 'the_title', $post->title );
				$content = apply_filters( 'the_content', $post->content );
				get_template_part( 'template-parts/blog/content' );
			endforeach;
			wp_reset_postdata();
			?>
		</div>
	</div>
</div>

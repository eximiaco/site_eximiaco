<?php
/**
 * The Author Single
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

global $post;

switch_to_blog( get_network()->site_id );

$author_id  = $post->post_author;
$author_pic = wp_get_attachment_image_src( get_user_meta( $author_id, 'pic', true ), 'thumbnail' );
?>

<div class="author-bio author-bio--single">
	<?php if ( ! empty( $author_pic[0] ) ) : ?>
	<div class="author-bio__picture">
		<img src="<?php echo wp_kses_post( $author_pic[0] ); ?>">
	</div>
	<?php endif; ?>

	<div class="author-bio__content">
		<p class="author-bio__name">
			<a href="<?php echo esc_attr( get_author_posts_url( $author_id ) ); ?>"><?php echo wp_kses_post( get_the_author_meta( 'display_name' ) ); ?></a>
		</p>
		<p><?php echo wp_kses_post( get_user_meta( $author_id, 'description', true ) ); ?></p>
	</div>
</div>

<?php restore_current_blog(); ?>

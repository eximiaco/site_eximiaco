<?php
/**
 * The Author navigation
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

/**
 * The application container.
 *
 * @var DI\Container
 */
global $container;

if ( get_query_var( 'paged' ) > 0 ) {
	return;
}

switch_to_blog( get_network()->site_id );

$author     = get_user_by( 'slug', get_query_var( 'author_name' ) );
$author_pic = wp_get_attachment_image_src( get_user_meta( $author->ID, 'pic', true ), 'thumbnail' );

?>

<div class="author-bio">
	<?php if ( ! empty( $author_pic[0] ) ) : ?>
	<div class="author-bio__picture">
		<img src="<?php echo wp_kses_post( $author_pic[0] ); ?>">
	</div>
	<?php endif; ?>

	<div class="author-bio__content">
		<p class="author-bio__name"><?php echo wp_kses_post( get_the_author_meta( 'display_name' ) ); ?></p>
		<p><?php echo wp_kses_post( get_user_meta( $author->ID, 'description', true ) ); ?></p>
	</div>
</div>

<?php restore_current_blog(); ?>

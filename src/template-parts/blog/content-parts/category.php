<?php
/**
 * The post listing category.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

$categories = get_the_category();

if ( empty( $categories ) ) {
	return;
}

?>
<ul class="listing-post__categories">
	<?php foreach ( $categories as $term ) : ?>
	<li>
		<?php if ( 'private' !== get_post_status() && 'bliki' !== get_post_type() ) : ?>
		<a href="<?php echo esc_url( get_term_link( $term, 'category' ) ); ?>">
			<?php echo esc_html( $term->name ); ?>
		</a>
		<?php else : ?>
		<p>
			<?php echo esc_html( $term->name ); ?>
		</p>
		<?php endif; ?>
	</li>
	<?php endforeach; ?>
</ul>

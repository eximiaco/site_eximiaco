<?php
/**
 * The post listing category.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

if ( is_post_type_archive( 'bliki' ) ) {
	return;
}

?>
<ul class="listing-post__categories">
	<?php if ( is_singular( 'bliki' ) ) : ?>
	<li>
		<a href="<?php echo esc_url( get_post_type_archive_link( 'bliki' ) ); ?>">Bliki</a>
	</li>
		<?php
		elseif ( 'private' !== get_post_status() ) :
			$categories = get_the_category();
			foreach ( $categories as $term ) :
				?>
	<li>
		<a href="<?php echo esc_url( get_term_link( $term, 'category' ) ); ?>">
				<?php echo esc_html( $term->name ); ?>
		</a>
	</li>
				<?php
			endforeach;
		endif;
		?>
</ul>

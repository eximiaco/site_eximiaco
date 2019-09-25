<?php
/**
 * The post serie.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

global $container;

if( ! have_rows( 'feature_repeater' ) ){
	return;
}
?>

<div class="post-feature">
	<h3 class="post-feature--title">
		<?php
			/* translators: more posts in series */
			echo esc_html( sprintf( __( 'This post was featured in', 'elemarjr' ), get_post_type() ) );
		?>
	</h3>

	<ul class="post-feature--list">
		<?php while ( have_rows( 'feature_repeater' ) ) : the_row(); ?>
			<li class="post-feature--item">
				<a class="post-feature--item-title" href="<?php echo esc_url( the_sub_field( 'feature_url' ) ); ?>" title="<?php echo esc_attr( the_sub_field( 'feature_title' ) ); ?>" target="_black">
				<span class="post-feature--item-site">
					<?php echo esc_html( the_sub_field( 'feature_site' ) ); ?>
				</span>
				<span>
					<?php echo esc_html( the_sub_field( 'feature_title' ) ); ?>
				</span>
				</a>
			</li>
		<?php endwhile; ?>
	</ul>
</div>

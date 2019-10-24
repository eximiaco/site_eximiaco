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

if ( ! have_rows( 'resums_repeater' ) ) {
	return;
}
?>

<div class="post-resums">
	<div class="post-resums__title">
		<?php
			/* translators: more posts in series */
			echo esc_html( sprintf( __( 'In Resum', 'elemarjr' ), get_post_type() ) );
		?>
	</div>

	<ul class="post-resums__list">
		<?php
		while ( have_rows( 'resums_repeater' ) ) :
			the_row();
			if ( ! empty( get_sub_field( 'resum_title' ) ) ) :
				?>
			<li class="post-resums__item">
				<h3 class="post-resums__item-title">
					<?php echo esc_html( the_sub_field( 'resum_title' ) ); ?>
				</h3>
				<?php echo esc_html( the_sub_field( 'resum_text' ) ); ?>
			</li>
				<?php
			endif;
		endwhile;
		?>
	</ul>
</div>

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

$abstract = '';

while ( have_rows( 'resums_repeater' ) ) {
	the_row();
	if ( ! empty( get_sub_field( 'resum_title' ) ) ) {
		$abstract .= sprintf(
			'<li class="post-resums__item">
			<h3 class="post-resums__item-title">%s</h3>
			%s
		</li>', get_sub_field( 'resum_title' ), get_sub_field( 'resum_text' )
		);
	}
}

if ( empty( $abstract ) ) {
	return;
}
?>

<div class="post-resums">
	<div class="post-resums__title">
		<?php
			/* translators: more posts in series */
			echo esc_html( sprintf( __( 'Abstract', 'elemarjr' ), get_post_type() ) );
		?>
	</div>

	<ul class="post-resums__list">
		<?php echo $abstract; ?>
	</ul>
</div>

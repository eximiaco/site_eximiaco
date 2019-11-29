<?php
/**
 * The post social medias.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

global $container;
$summary = get_post_meta( get_the_ID(), 'post-summary', true );

if ( empty( $summary ) || ! get_field( 'show_summary' ) ) {
	return;
}

?>
<div class="summary">
	<h3 class="summary--title">
		<?php echo esc_html( __( 'Summary', 'elemarjr' ) ); ?>
	</h3>
	<?php $container->get( Aztec\Pages\Blog::class )->get_summary_item( $summary ); ?>
</div>

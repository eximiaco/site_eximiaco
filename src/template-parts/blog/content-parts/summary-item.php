<?php
/**
 * The summary item
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

?>

<ul class="summary--items">

	<?php
	$node = get_query_var( 'summary_node' );
	foreach ( $node as $item ) :
		?>
		<li>
			<a href="javascript:void(0)" class="summary--anchor" data-anchor="<?php echo esc_html( $item['tag_id'] ); ?>">
				<?php echo esc_html( $item['tag_content'] ); ?>
			</a>

			<?php
				global $container;
			if ( ! empty( $item['children'] ) ) {
				$container->get( Aztec\Pages\Blog::class )->get_summary_item( $item['children'] );
			}
			?>
		</li>
	<?php endforeach; ?>
</ul>

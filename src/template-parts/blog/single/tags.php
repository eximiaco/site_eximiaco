<?php
/**
 * The post footer.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

?>

<?php
	$terms = get_the_terms( get_the_ID(), 'post_tag' );
	$tags  = wp_list_pluck( $terms, 'name' );
?>
<?php if( ! empty( $tags ) ):?>
<footer class="post--footer">
	<div class="post--tags">
		<strong><?php echo esc_html_e( 'Tags', 'elemarjr' ); ?></strong>
		<?php
		if ( 'bliki' !== get_post_type() ) {
			the_terms( get_the_ID(), 'post_tag', '', '', '' );
		} else {
			foreach ( $tags as $tag ) :
				?>
				<span><?php echo esc_html( $tag ); ?></span>
				<?php
			endforeach;
		}
		?>
	</div>
</footer>
<?php endif;?>

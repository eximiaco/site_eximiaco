<?php
/**
 * The application container
 * 
 * @var DI\Container 
 */
global $container;
?>
<nav class="category-nav">
	<ul>
		<?php
			wp_list_categories( array(
				'title_li' => false
			) );
			
			$home_url = $container->get( Aztec\Helper\Url::class )->get_post_page_url();
		?>
		<li class="cat-item">
			<a href="<?php echo esc_url( $home_url ); ?>"><?php esc_html_e( 'Show All', 'elemarjr' ); ?></a>
		</li>
	</ul>
</nav>
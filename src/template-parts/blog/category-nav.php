<?php
/**
 * The post category navigation.
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
$user_categories  = get_query_var( 'custom_nav_categories' );
$current_category = single_cat_title( '', false );

if ( '' !== $current_category ) { ?>
	<h1 style="display:none;"><?php echo esc_html( $current_category ); ?></h1>
<?php } ?>
<nav class="category-nav">
	<ul>
		<?php
			$home_classes = array( 'cat-item' );
		if ( is_home() ) {
			$home_classes[] = 'current-cat';
		}

			$home_url = $container->get( Aztec\Helper\Url::class )->get_post_page_url();

		if ( ! empty( $user_categories ) ) {
			$home_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
		}
		?>
		<li class="<?php echo esc_attr( join( ' ', $home_classes ) ); ?>">
			<a href="<?php echo esc_url( $home_url ); ?>"><?php esc_html_e( 'Show All', 'elemarjr' ); ?></a>
		</li>
		<?php
		if ( ! empty( $user_categories ) ) {
			foreach ( $user_categories as $category ) {
				?>
					<li class="cat-item">
						<a href="<?php echo esc_url( $container->get( Aztec\Helper\Permalink::class )->get_author_category_permalink( pll_current_language(), get_query_var( 'author_name' ), $category->slug ) ); ?>"><?php echo esc_html( $category->name ); ?></a>
					</li>
				<?php
			}
		} else {
			wp_list_categories(
				array(
					'title_li' => false,
				)
			);
		}
		?>
	</ul>
</nav>

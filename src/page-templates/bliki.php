<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of <pages></pages>
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * Template name: Bliki
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

global $container;

$bliki_query = $container->get( Aztec\PostType\Bliki::class )->get_blikis( $paged );
$blikis = $bliki_query->posts;

get_header(); ?>

<?php get_template_part( 'template-parts/blog/category-nav' ); ?>

<main>
	<?php
	while ( have_posts() ) :
		the_post();
		?>
	<div class="container">
		<div class="post-list">
			<div class="post-list__loading">
				<?php esc_html_e( 'Loading posts...', 'elemarjr' ); ?>
			</div>
			<div class="cards-list">
				<div class="cards-list__wrapper">
				<?php
					foreach ( $blikis as $post ) :
						setup_postdata( $post );
						get_template_part( 'template-parts/blog/content' );
					endforeach;
					wp_reset_postdata();
				?>
				</div>
			</div>
		</div>
	</div>
	<div class="posts-nav">
		<?php
			// Change the custom query to use the default pagination
			query_posts( $bliki_query->query );
			posts_nav_link( ' ', __( 'Previous Page', 'elemarjr' ), __( 'Next Page', 'elemarjr' ) );
			// Restore to custom query
			wp_reset_query();
		?>
	</div>
	<?php
	endwhile;
	?>
</main>

<?php get_footer(); ?>

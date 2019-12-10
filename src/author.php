<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

use Aztec\Helper\BackgroundImage;

global $container, $wp_query;

$author_id         = get_the_author_meta( 'ID' );
$author_categories = $container->get( Aztec\Query\Author::class )->get_author_categories( $author_id );

set_query_var( 'custom_nav_categories', $author_categories );

get_header();
?>
	<?php get_template_part( 'template-parts/author/bio' ); ?>

	<main>
		<?php get_template_part( 'template-parts/blog/category-nav' ); ?>

		<?php
			$container->set( 'post_list.query', $wp_query );
			$container->set( 'post_list.extra_class', '' );
			$template = $wp_query->have_posts() ? null : 'empty';
			get_template_part( 'template-parts/blog/post-list', $template );
		?>

		<div class="posts-nav">
			<?php posts_nav_link( ' ', __( 'Previous Page', 'elemarjr' ), __( 'Next Page', 'elemarjr' ) ); ?>
		</div>
	</main>

<?php get_footer(); ?>

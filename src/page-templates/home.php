<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * Template name: Home
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

use Aztec\Helper\Url;

global $container;
$url_helper   = $container->get( Url::class );

get_header(); ?>

<main>
	<?php
	while ( have_posts() ) :
		the_post();
		?>
	<?php get_template_part( 'template-parts/hero/hero-slider' ); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'front-page' ); ?>>

		<?php get_template_part( 'template-parts/page/home/clients' ); ?>

		<?php get_template_part( 'template-parts/page/home/cards' ); ?>

		<?php
		set_query_var( 'testimonials', $testimonials );
		get_template_part( 'template-parts/page/home/testimonials' );
		?>

		<?php get_template_part( 'template-parts/page/home/contents' ); ?>

		<?php get_template_part( 'template-parts/page/home/websites' ); ?>

		<?php get_template_part( 'template-parts/page/home/posts-list' ); ?>

		<?php get_template_part( 'template-parts/page/home/purpose' ); ?>

		<?php get_template_part( 'template-parts/page/home/quote' ); ?>

	</article>

<?php endwhile; ?>
</main>

<?php get_footer(); ?>

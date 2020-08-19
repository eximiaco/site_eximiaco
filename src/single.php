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

global $container;

get_header(); ?>

	<main>

		<?php
		while ( have_posts() ) :
			the_post();
			?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php get_template_part( 'template-parts/blog/single/translate-request' ); ?>

			<header class="post--header container">

			<?php get_template_part( 'template-parts/blog/content-parts/category' ); ?>

			<?php get_template_part( 'template-parts/blog/content-parts/serie' ); ?>

			<?php the_title( '<h1 class="post--title">', '</h1>' ); ?>

			<?php get_template_part( 'template-parts/blog/single/meta' ); ?>
			</header>
			<?php get_template_part( 'template-parts/blog/content-parts/progress-bar' ); ?>
			<section class="container">
				<div class="post--main">
					<?php get_template_part( 'template-parts/blog/single/content' ); ?>
				</div>
			</section>

			<section class="container">
			<?php get_template_part( 'template-parts/blog/single/resums' ); ?>

			<?php get_template_part( 'template-parts/author/bio-single' ); ?>

			<?php get_template_part( 'template-parts/blog/single/feature' ); ?>

			<?php get_template_part( 'template-parts/blog/single/tags' ); ?>

			<?php
			if ( 'bliki' !== get_post_type() ) {
				get_template_part( 'template-parts/blog/single/post-nav' );

				// List related posts
				do_action( 'get_related_posts' );
			}
			?>

			<?php get_template_part( 'template-parts/blog/single/serie' ); ?>

			<?php get_template_part( 'template-parts/blog/single/banner-contact' ); ?>

			<?php get_template_part( 'template-parts/blog/single/promotion' ); ?>


			<?php comments_template(); ?>
			</section>
		</article>

		<?php endwhile; ?>
	</main>

<?php get_footer(); ?>

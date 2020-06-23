<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * Template name: Drops
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

get_header(); ?>

	<main>
		<?php
		while ( have_posts() ) :
			the_post();
			?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="rich-content">
				<div class="main-content">
					<div class="title"><?php esc_attr_e( 'Drops from ExímiaCo', 'elemarjr' ); ?></div>
					<?php the_content(); ?>
					<div class="follow-us">
						<div class="title"><?php esc_attr_e( 'Also listen in other platforms', 'elemarjr' ); ?></div>
						<?php get_template_part( 'template-parts/store-menu' ); ?>
					</div>
				</div>
			</div>
		</article>
		<?php endwhile; ?>
	</main>

<?php get_footer(); ?>

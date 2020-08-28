<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * Template name: About
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

get_header();

use Aztec\Helper\PageSection;

global $container;

$page_section = $container->get( PageSection::class ); ?>

<main>
	<?php
	while ( have_posts() ) :
		the_post();
		?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'rich-content' ); ?>>
		<?php
		get_template_part( 'template-parts/hero/hero-slider' );

		while ( have_rows( 'about_repeater' ) ) :
			the_row();
			?>
			<div class="<?php echo esc_attr( $page_section->get_row_classes() ); ?>">
				<?php get_template_part( 'template-parts/page-sections' ); ?>
			</div>

			<?php endwhile; ?>
	</article>
	<?php endwhile; ?>
</main>

<?php get_footer(); ?>

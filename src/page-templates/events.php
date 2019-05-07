<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * Template name: Events Calendar
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

use Aztec\Pages\About;

global $container;

$events_by_year = $container->get( Aztec\PostType\Event::class )->get_events_by_year();

get_header(); ?>

<main>
	<?php
	while ( have_posts() ) :
		the_post();
		?>
	<?php
	$text_event = explode('<p>&nbsp;</p>', get_field( 'cta_text' ) );
	$text_header = $text_event[0];
	$text_footer = $text_event[1];
	?>
	<div class="container events__container">
		<div class="page-header">
			<h3 class="page-header--title"><?php the_title(); ?></h3>
		</div>
		<h4 class="events-header--subtitle"><?php echo $text_header; ?></h5>
		<?php foreach ( $events_by_year as $year => $events ) : ?>
		<div class="cards-list cards-list--events">
			<div class="cards-list__wrapper">
				<?php
				foreach ( $events as $post ) :
					setup_postdata( $post );
					get_template_part( 'template-parts/event/event' );
				endforeach;
				wp_reset_postdata();
				?>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<div class="events__about">
		<div class="container events__container">
			<div class="events--about-text">
				<?php echo $text_footer; ?>
			</div>
		</div>
	</div>
	<?php endwhile; ?>
</main>

<?php get_footer(); ?>

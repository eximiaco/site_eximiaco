<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * Template name: Newsletters Calendar
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

global $container;

if ( 'pt' !== pll_current_language() ) {
	global $wp_query;
	$wp_query->set_404();
	status_header( 404 );
	get_template_part( 404 );
	exit();
}

$newsletters_by_year = $container->get( Aztec\PostType\Newsletter::class )->get_newsletters_by_year();

get_header(); ?>

<main>
	<div class="container newsletters__container">
	<?php
	switch_to_blog( get_network()->site_id );
	foreach ( $newsletters_by_year as $year => $newsletters ) : ?>
		<div class="page-header">
			<h3 class="page-header--title"><?php echo esc_html( __( 'Newsletter', 'elemarjr' ) ); ?> <b><?php echo esc_html( $year ); ?></b></h3>
		</div>
		<div class="cards-list cards-list--newsletters post-list__loaded animated fadeInUpBig">
			<div class="cards-list__wrapper">
			<?php foreach ( $newsletters as $post ) :
				if ( has_post_thumbnail( $post->ID ) ) : ?>
				<a href="<?php echo esc_url( $post->post_content ); ?>" class="card card--white card--newsletters card--old" target="_blank">
					<div class="card__wrapper">
						<img src="<?php echo esc_url( get_the_post_thumbnail_url( $post->ID) ); ?>'" alt="<?php echo esc_html( get_the_post_thumbnail_caption() ); ?>">
						<time class="card__date">
							<span class="card__date-bordered"><?php esc_attr_e ( get_the_date( 'd M', $post->ID ) ); ?></span>
						</time>
					</div>
				</a>
				<?php endif;
			endforeach; ?>
			</div>
		</div>
	<?php endforeach;
	restore_current_blog(); ?>
	</div>
</main>

<?php get_footer(); ?>

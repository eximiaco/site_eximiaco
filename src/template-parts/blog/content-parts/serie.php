<?php
/**
 * The post series.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

/**
 * Display the post serie name
 *
 * The link over the series name is the term archive link in single and the post link in the post listing.
 */
use Aztec\Taxonomy\Serie;

global $container;

/**
 * Serie helper.
 *
 * @var Serie $serie_helper
 */

if ( 'post' !== get_post_type() ) {
	return;
}
$serie_helper = $container->get( Serie::class );

$series = $serie_helper->get_post_terms( get_the_ID() );

if ( $series ) :

	foreach ( $series as $term ) :
		$link = is_single() ? $serie_helper->get_serie_link( $term ) : get_the_permalink();
		?>
		<?php if ( 'bliki' !== get_post_type() ) : ?>
		<a class="listing-post__serie" href="<?php echo esc_url( $link ); ?>">
			<?php echo esc_html( $term->name ); ?>
		</a>
		<?php else : ?>
		<span class="listing-post__serie">
			<?php echo esc_html( $term->name ); ?>
		</span>
		<?php endif; ?>
		<?php
	endforeach;
	else :
		?>
<div class="listing-post__serie"></div>
	<?php endif; ?>

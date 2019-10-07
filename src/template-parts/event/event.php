<?php
/**
 * Event component.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

$event_class = '';
$now         = new DateTime( date( 'Y-m-d' ) );
$end         = new DateTime( get_field( 'event_end' ) );
$start       = new DateTime( get_field( 'event_start' ) );

$event_days   = $start->format( 'd' );
$event_months = date_i18n( 'F', $start->getTimestamp() );
$diff_in_days = $end->diff( $start )->days;

$current_day = clone $start;
for ( $i = 1; $i <= $diff_in_days; ++$i ) {
	$division = $i === $diff_in_days ? ' ' . __( 'and', 'elemarjr' ) . ' ' : ', ';
	$current_day->modify( '+1 day' );
	$event_days .= $division . ( sprintf( '%02d', $current_day->format( 'd' ) ) );
}

$month_end = date_i18n( 'F', $end->getTimestamp() );

if ( $event_months !== $month_end ) {
	$event_months .= ' / ' . $month_end;
}

// Check if events happened or is happening.
$now_timestamp   = $now->getTimestamp();
$start_timestamp = $start->getTimestamp();
$end_timestamp   = $end->getTimestamp();

if ( $now_timestamp >= $start_timestamp && $now_timestamp <= $end_timestamp ) {
	$event_class = 'card--active';
} elseif ( $now_timestamp > $end_timestamp ) {
	$event_class = 'card--old';
}

// Use `div` for elements without URL and `a` for elements with URL.
$url = get_field( 'event_url' );
if ( '' === $url ) {
	$el = [
		'tag'  => 'div',
		'href' => '',
	];
} else {
	$el = [
		'tag'    => 'a',
		'href'   => get_field( 'event_url' ),
		'target' => '_blank',
	];
}
// phpcs:disable
echo '<';
echo esc_html( $el['tag'] . ' ' );

if ( ! empty( $el['href'] ) ) :
	echo ' href="' . esc_url( $el['href'] ) . '" target="' . esc_attr( $el['target'] ) . '"';
endif;
?>
 class="card card--white card--event <?php echo esc_attr( $event_class ); ?>">
 <?php // phpcs:enable ?>
	<div class="card__wrapper">
		<div class="card__header">
			<time class="card__date">
				<?php echo esc_html( $event_months ); ?><br><?php echo esc_html( $event_days ); ?>
			</time>
			<div class="card__image">
				<?php the_post_thumbnail(); ?>
			</div>
		</div>
		<div class="card__content">
			<p class="card__role"><?php the_field( 'event_role' ); ?></p>
			<h3 class="card__title"><?php the_field( 'event_name' ); ?></h3>
			<?php if ( ! empty( get_field( 'event_responsible' ) ) ) : ?>
			<p class="card__responsible"><?php the_field( 'event_responsible' ); ?></p>
			<?php endif; ?>
		</div>
		<div class="card__footer"><?php the_title(); ?></div>
	</div>
</<?php echo esc_html( $el['tag'] ); ?>>

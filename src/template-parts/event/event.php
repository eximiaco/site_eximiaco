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
	$division = $i === $diff_in_days ? ' e ' : ', ';
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
	$event_class = 'event__active';
} elseif ( $now_timestamp > $end_timestamp ) {
	$event_class = 'event__old';
}

// Use `div` for elements without URL and `a` for elements with URL.
$url = get_field( 'event_url' );
if( '' === $url ) {
	$tag = [
		'div',
		''
	];
} else {
	$tag = [
		'a',
		'href="' . esc_url( get_field( 'event_url' ) ) . '" target="_blank"'
	];
}

?>
<<?php echo esc_html( $tag[0] ) ?> <?php echo $tag[1] ?> class="event <?php echo esc_attr( $event_class ); ?>">
	<div class="event--wrapper">
		<div class="event--container">
			<div class="event--header">
				<time class="event--date">
					<?php echo esc_html( $event_months ); ?><br><?php echo esc_html( $event_days ); ?>
				</time>
				<div class="event--image">
					<?php the_post_thumbnail(); ?>
				</div>
			</div>
			<div class="event--content">
				<p class="event--role"><?php the_field( 'event_role' ); ?></p>
				<h3 class="event--title"><?php the_field( 'event_name' ); ?></h3>
			</div>
			<div class="event--footer"><?php the_title(); ?></div>
		</div>
	</div>
</<?php echo esc_html( $tag[0] ) ?>>

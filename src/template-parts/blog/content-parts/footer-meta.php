<?php
/**
 * The footer meta data.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

use Bookworm\Bookworm;
?>
<?php if ( 'bliki' !== get_post_type() ):?>
	<div class="listing-post--date">
		<?php echo esc_html( get_the_date() ); ?>
	</div>
<?php endif;?>

<div class="listing-post__footer__right">
	<span class="listing-post--reading">
		<?php echo esc_html( Bookworm::estimate( get_the_content(), 'M' ) ); ?>
		<i class="i-time"></i>
	</span>
	<span class="listing-post--comments">
			<?php echo esc_html( get_comments_number() ); ?>
		<i class="i-comments"></i>
	</span>
</div>

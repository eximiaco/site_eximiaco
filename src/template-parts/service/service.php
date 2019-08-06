<?php
/**
 * Event component.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

use Aztec\Helper\Text;

global $container;
?>

<div class="card card--white card--service">
	<div class="card__wrapper">
		<div class="card__header">
			<div class="card__thumbnail"><?php the_post_thumbnail(); ?></div>
			<h3 class="card__title">
				<?php echo wp_kses_post( $container->get( Text::class )->asterisk_to_strong( get_the_title() ) ); ?>
			</h3>
		</div>
		<div class="card__content">
			<?php echo wp_kses_post( wpautop( mb_strimwidth( get_the_content(), 0, 320, '...' ) ) ); ?>
		</div>
		<div class="card__footer">
			<a href="<?php the_permalink(); ?>" class="card__button">Saiba mais <i class="i-shaft"></i></a>
		</div>
	</div>
</div>

<?php
/**
 * Cards on homepage
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

if ( ! have_rows( 'contents_repeater' ) )  {
	return;
}
?>

<div class="front-page--contents home-contents">
	<div class="home-contents__bg"></div>
	<div class="container container__xs-small-margin">
		<h2 class="home-contents__title wow fadeIn"><?php echo wp_kses_post( get_field( 'contents_title' ) ); ?></h2>
		<div class="home-contents__list">
			<div class="home-contents__item">
				<h3 class="home-contents__item-title"><?php echo __( 'Blog', 'elemarjr' ); ?></h3>
				<?php
				set_query_var( 'posts_per_page', '1');
				get_template_part( 'template-parts/page/home/posts' );
				?>
			</div>
			<?php while ( have_rows( 'contents_repeater' ) ) :
				the_row();
				$contents_image = get_sub_field( 'content_image' ); ?>
				<div class="home-contents__item">
					<h3 class="home-contents__item-title"><?php echo wp_kses_post( get_sub_field( 'content_title' ) ); ?></h3>
					<article class="card listing-post animated fadeInUpBig">
						<div class="card__wrapper">
							<div class="listing-post__container">
								<div class="listing-post__bg" style="background-image: url('<?php echo esc_url( wp_get_attachment_image_url( $contents_image['ID'], 'thumbnail' ) ); ?>')"></div>
								<div class="listing-post__bg__overlay"></div>
								<div class="listing-post__overlay">
									<header class="listing-post__header">
										<div class="listing-post__header-meta">
											<ul class="listing-post__categories">
											<?php
											while ( have_rows( 'contents_tags' ) ) :
												the_row();
												if ( '' !== get_sub_field( 'content_tags' ) ) : ?>
												<li><a><?php echo wp_kses_post( get_sub_field( 'content_tags' ) ); ?></a></li>
											<?php endif;
											endwhile; ?>
											</ul>
											<div class="listing-post__serie"></div>
										</div>
										<h2 class="listing-post__title">
											<a href="<?php echo wp_kses_post( get_sub_field( 'content_url' ) ); ?>" rel="bookmark" <?php if ( get_sub_field( 'content_target' ) ) { echo 'target="_blank"'; } ?>>
												<span><?php echo wp_kses_post( get_sub_field( 'content_text' ) ); ?></span>
											</a>
										</h2>
									</header>
								</div>
							</div>
						</div>
					</article>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
</div>

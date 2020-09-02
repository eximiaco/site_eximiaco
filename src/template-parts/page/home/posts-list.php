<?php
/**
 * Posts list on homepage
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

global $container;

if ( empty( get_field( 'blog_text' ) ) )  {
	return;
}
?>

<div class="front-page--blog">
	<div class="container container__xs-small-margin">
		<h2 class="front-page--blog-title wow fadeIn"><?php esc_html_e( 'Blog', 'elemarjr' ); ?></h2>
		<?php
		$container->set(
			'template.home.blog', [
				'description' => get_field( 'blog_text' ),
			]
		);
		get_template_part( 'template-parts/page/home/blog' );

		if ( pll_current_language() !== 'en' ) {
			$container->set(
				'template.home.blog', [
					'language'    => 'en',
					'description' => __( 'Last posts in English', 'elemarjr' ),
				]
			);
			get_template_part( 'template-parts/page/home/blog' );
		}
		?>
	</div>
</div>

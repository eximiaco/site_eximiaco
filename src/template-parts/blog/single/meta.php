<?php
/**
 * The post meta data.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

use Aztec\Form\TranslateRequest as TranslateRequestForm;
use Bookworm\Bookworm;

global $container;

$form = $container->get( TranslateRequestForm::class );
?>

<div class="post--meta">
	<div class="post--meta-author">
	<?php
	// Check if the co-author plugin is installed.
	if ( function_exists( 'coauthors_posts_links' ) ) :
		$coauthors = get_coauthors();
		foreach ( $coauthors as $coauthor ) : ?>
			<a href="<?php echo esc_url( get_author_posts_url( $coauthor->ID ) ); ?>">
				<?php echo esc_html( $coauthor->display_name ); ?>
			</a>
		<?php
		endforeach;
	else : ?>
		<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
			<?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?>
		</a>
	<?php endif; ?>
	</div>

	<?php if ( get_post_type() !== 'bliki' ) : ?>
	<div class="post--meta-date">
		<?php echo esc_html( get_the_date() ); ?>
	</div><!-- .post--meta-data -->
	<?php endif; ?>

	<div class="post--meta-reading">
		<span class="post--icon__time"></span>
		<?php echo esc_html_e( 'reading time:', 'elemarjr' ); ?>
		<?php echo esc_html( Bookworm::estimate( get_the_content(), ' min' ) ); ?>
	</div><!-- .post--meta-reading -->

</div><!-- .post--meta -->
<div class="post--meta post--meta-lang">
	<?php
		// test if the plugin polylang is present.
	if ( isset( $GLOBALS['polylang'] ) ) {

		$languages_list = PLL()->model->get_languages_list();
		$translations   = $GLOBALS['polylang']->model->post->get_translations( $post->ID );

		foreach ( $languages_list as $language ) {
			$labels = array(
				'read'            => get_theme_mod( $form->get_theme_mod_control_id( $language, 'link_read' ), false ),
				'request'         => get_theme_mod( $form->get_theme_mod_control_id( $language, 'link_request' ), false ),
				'message'         => get_theme_mod( $form->get_theme_mod_control_id( $language, 'form_message' ), false ),
				'input_name'      => get_theme_mod( $form->get_theme_mod_control_id( $language, 'form_input_name' ), false ),
				'input_email'     => get_theme_mod( $form->get_theme_mod_control_id( $language, 'form_input_email' ), false ),
				'btn_submit'      => get_theme_mod( $form->get_theme_mod_control_id( $language, 'form_btn_submit' ), false ),
				'message_success' => get_theme_mod( $form->get_theme_mod_control_id( $language, 'form_feedback_message_success' ), false ),
				'message_error'   => get_theme_mod( $form->get_theme_mod_control_id( $language, 'form_feedback_message_error' ), false ),
			);

			if ( $GLOBALS['polylang']->curlang->slug !== $language->slug && ! empty( $labels['message'] ) ) :

				if ( isset( $translations[ $language->slug ] ) ) :
					?>
							<a href="<?php echo esc_url( get_permalink( $translations[ $language->slug ] ) ); ?>" class="post--meta-translate">
							<?php echo esc_html( $labels['read'] ); ?>
							</a>
						<?php
					else :
						?>
						<a href="javascript:void(0)"
							data-language="<?php echo esc_html( $language->slug ); ?>"
							data-form-message="<?php echo esc_html( $labels['message'] ); ?>"
							data-input-name="<?php echo esc_html( $labels['input_name'] ); ?>"
							data-input-email="<?php echo esc_html( $labels['input_email'] ); ?>"
							data-submit="<?php echo esc_html( $labels['btn_submit'] ); ?>"
							data-message-success="<?php echo esc_html( $labels['message_success'] ); ?>"
							data-message-error="<?php echo esc_html( $labels['message_error'] ); ?>"
							class="post--meta-translate request-translate">
							<?php echo esc_html( $labels['request'] ); ?>
						</a>

						<?php
				endif;
			endif;
		}
	}
	?>
</div><!-- .post--meta -->

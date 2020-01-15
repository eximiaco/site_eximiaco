<?php
/**
 * The post translate request.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

use Aztec\Form\TranslateRequest as TranslateRequestForm;

global $container;

$form   = $container->get( TranslateRequestForm::class );
$values = $form->get_flash();

$message = $container->get( 'contact.message_id' );


if ( ! empty( $message ) ) {
	$message_language = '';
	$languages_list   = PLL()->model->get_languages_list();
	foreach ( $languages_list as $language ) {
		if ( $message['language'] === $language->slug ) {
			$message_language = $language;
		}
	}
	if ( ! empty( $message_language ) ) {
		$return_status = ( 'success' === $message['message'] ) ? 'success' : 'error';
		$message_text  = get_theme_mod( $form->get_theme_mod_control_id( $message_language, "form_feedback_message_{$return_status}" ), false );

		set_query_var( 'translate-request-message', $message_text );
		get_template_part( 'template-parts/blog/single/message', $return_status );
	}
}
?>
<div id="translate-request-box" class="container">
	<p class="btn-close text-right">
		<i class="i-cross btn-close-icon" id="close-translate-form"></i>
	</p>
	<p class="contact--description text-center">
		<span id="request-message"></span>
	</p>

	<div class="contact">
		<form action="<?php echo esc_url( wp_nonce_url( $form->get_action() ) ); ?>" method="POST" class="contact--form form">

			<label for="name">
				<input type="text" name="name" placeholder="" value="" id="translate-request-input-name" required />
			</label>
			<label for="email">
				<input type="email" name="email" placeholder="" value="" id="translate-request-input-email" required />
			</label>
			<input type="hidden" name="language" value="" id="language-input">
			<input type="hidden" name="message_success" value="" id="language-message-success">
			<input type="hidden" name="message_error" value="" id="language-message-error">
			<?php wp_nonce_field( 'translate-request' ); ?>
			<div class="form--submit-wrapper">
				<?php
					set_query_var( 'submit_button_id', 'translate-request-submit' );
					set_query_var( 'submit_button_class', 'button button__bordered' );
					set_query_var( 'submit_button_callback', 'postContact' );
					get_template_part( 'template-parts/recaptcha/nocaptcha' );
				?>
			</div>
		</form>
	</div>
</div>

<?php
/**
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

global $container;

if ( post_password_required() ) {
	return;
}

$comment_callback = $container->get( Aztec\Setup\Comments::class )->callback( 'comment_template' );
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
	<div class="comments-area--number">
		<?php
			$n               = (int) get_comments_number();
			$comments_string = __( 'No Comments' );
		if ( 1 === $n ) {
			$comments_string = __( '1 Comment' );
		} elseif ( 1 < $n ) {
			$comments_string = $n . ' ' . __( 'Comments' );
		}

			echo esc_html( $comments_string );
		?>
	</div>

	<ol class="comment-list">
		<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 64,
					'callback'    => $comment_callback,
				)
			);
		?>
	</ol><!-- .comment-list -->

		<?php
			echo wp_kses_post( apply_filters( 'elemar_comments_navigation_template', get_the_comments_navigation() ) );

			// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
				<p class="comments-area--closed"><?php esc_html_e( 'Comments are closed.', 'elemarjr' ); ?></p>
			<?php
			endif;

		endif; // Check for have_comments().

		set_query_var( 'submit_button_id', 'captcha_submit_comment' );
		set_query_var( 'submit_button_class', 'button' );
		set_query_var( 'submit_button_text', __( 'Post Comment', 'elemarjr' ) );
		set_query_var( 'submit_button_callback', 'submitComment' );

		ob_start();
		get_template_part( 'template-parts/recaptcha/nocaptcha' );
		$submit_button = ob_get_contents();
		ob_end_clean();

		comment_form(
			array(
				'class_form'   => 'form comment-form',
				'class_submit' => 'button',
				'submit_button' => $submit_button
			)
		);
		?>
</div><!-- #comments -->

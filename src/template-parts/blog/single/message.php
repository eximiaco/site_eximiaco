<?php
/**
 * Contact message.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

global $container;
?>
<div class="return-message-box container">
	<p class="btn-close text-right">
		<i class="i-cross btn-close-icon" id="close-message-box"></i>
	</p>
	<p class="return-message return-message--success">
		<?php echo esc_html( get_query_var( 'translate-request-message' ) ); ?>
	</p>
</div>

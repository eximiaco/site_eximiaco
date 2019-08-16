<?php
/**
 * Error message.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

global $container;
?>
<p class="return-message return-message--error">
	<?php echo esc_html( get_query_var( 'translate-request-message' ) ); ?>
</p>

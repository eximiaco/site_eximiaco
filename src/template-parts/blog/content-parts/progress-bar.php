<?php
/**
 * The post progress-bar.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */
if ( ! is_singular( 'post' ) && ! is_singular( 'bliki' ) ) {
    return;
}
?>
<div class="progress" id="myBar1">
	<div class="progress__bar" id="myBar2"></div>
</div>

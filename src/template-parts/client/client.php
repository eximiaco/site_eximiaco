<?php
/**
 * Client component.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

?>

<?php

$client_logo = get_field('client_logo');

if (empty($client_logo)) {
	return;
}

$image = wp_get_attachment_image_src($client_logo['ID'], 'client_logo');
$url = get_field('client_url');

$open_tag = '<%s class="client" %s >';
$close_tag = '</%s>';

if (empty($url)) {
	$el = array(
		'tag' => 'div',
		'attrs' => ''
	);
} else {
	$el = array(
		'tag' => 'a',
		'attrs' => 'href="' . esc_url( $url ) . '" target="_blank"'
	);
}

$open_tag = sprintf(
	$open_tag,
	$el['tag'],
	$el['attrs']
);
$close_tag = sprintf($close_tag, $el['tag']);


echo $open_tag;
?>
<div class="client__wrapper">
	<img src="<?php echo esc_attr($image[0]); ?>" alt="<?php esc_attr(the_title()); ?>" title="<?php esc_attr(the_title()); ?>">
</div>
<?php echo $close_tag;

<?php
/**
 * The Author Single
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

global $post;

$author_url = array();

// Get coauthors before switch to main blog.
if ( function_exists( 'coauthors_posts_links' ) ) {
	$coauthors = get_coauthors();
	foreach ( $coauthors as $coauthor ) {
		$author_url[$coauthor->ID] = get_author_posts_url( $coauthor->ID );
	}
} else {
	$author_id  = $post->post_author;
	$author_url[$author_id] = get_author_posts_url( $author_id );
}

switch_to_blog( get_network()->site_id );
?>

<div class="author">
	<?php
	// Check if the co-author plugin is installed.
	if ( function_exists( 'coauthors_posts_links' ) ) :
		foreach ( $coauthors as $coauthor ) :
			$author_pic = wp_get_attachment_image_src( get_user_meta( $coauthor->ID, 'pic', true ), 'thumbnail' );
			$author_twitter = get_user_meta( $coauthor->ID, 'twitter', true);
			$author_linkedin = get_user_meta( $coauthor->ID, 'googleplus', true);
			$author_facebook = get_user_meta( $coauthor->ID, 'facebook', true);
			$user_info = get_userdata( $coauthor->ID );
			$author_email = $user_info->user_email;
			$author_github = $user_info->user_url; ?>
			<div class="author-bio author-bio--single author-bio--single-coauthor">
				<?php if ( ! empty( $author_pic[0] ) ) : ?>
				<div class="author-bio__picture">
					<img src="<?php echo wp_kses_post( $author_pic[0] ); ?>">
				</div>
				<?php endif; ?>
				<div class="author-bio__content">
					<p class="author-bio__name">
						<a href="<?php echo esc_attr( $author_url[ $coauthor->ID ] ); ?>">
							<?php echo wp_kses_post( get_the_author_meta( 'display_name', $coauthor->ID ) ); ?>
						</a>
					</p>
					<p><?php echo wp_kses_post( get_user_meta( $coauthor->ID, 'description', true ) ); ?></p>
					<?php if ( ! empty( $author_twitter ) ) : ?>
						<div class="author-bio__share-item">
							<a target="_blank" title="Twitter" href="<?php echo wp_kses_post( $author_twitter );?>">
								<i class="i-twitter"></i>
							</a>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $author_linkedin ) ) : ?>
						<div class="author-bio__share-item">
							<a target="_blank" title="Linkedin" href="<?php echo wp_kses_post( $author_linkedin );?>">
								<i class="i-linkedin"></i>
							</a>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $author_facebook ) ) : ?>
						<div class="author-bio__share-item">
							<a target="_blank" title="Facebook" href="<?php echo wp_kses_post( $author_facebook );?>">
								<i class="i-facebook"></i>
							</a>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $author_email ) ) : ?>
						<div class="author-bio__share-item">
							<a target="_blank" title="Contato" href="mailto:<?php echo wp_kses_post( $author_email );?>">
								<i class="i-mail"></i>
							</a>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $author_github ) ) : ?>
						<div class="author-bio__share-item">
							<a target="_blank" title="Github" href="<?php echo wp_kses_post( $author_github );?>">
								<i class="i-github"></i>
							</a>
						</div>
					<?php endif; ?>
				</div>
			</div>
		<?php
		endforeach;
	else :
		$author_id  = $post->post_author;
		$author_pic = wp_get_attachment_image_src( get_user_meta( $author_id, 'pic', true ), 'thumbnail' );
		$author_twitter = get_user_meta( $author_id, 'twitter', true);
		$author_linkedin = get_user_meta( $author_id, 'googleplus', true);
		$author_facebook = get_user_meta( $author_id, 'facebook', true);
		$user_info = get_userdata( $author_id );
		$author_email = $user_info->user_email;
		$author_github = $user_info->user_url;
		?>
		<div class="author-bio author-bio--single">
			<?php if ( ! empty( $author_pic[0] ) ) : ?>
			<div class="author-bio__picture">
				<img src="<?php echo wp_kses_post( $author_pic[0] ); ?>">
			</div>
			<?php endif; ?>
			<div class="author-bio__content">
				<p class="author-bio__name">
					<a href="<?php echo esc_attr( $author_url[$author_id] ); ?>"><?php echo wp_kses_post( get_the_author_meta( 'display_name' ) ); ?></a>
				</p>
				<p><?php echo wp_kses_post( get_user_meta( $author_id, 'description', true ) ); ?></p>
				<?php if ( ! empty( $author_twitter ) ) : ?>
					<div class="author-bio__share-item">
						<a target="_blank" title="Twitter" href="<?php echo wp_kses_post( $author_twitter );?>">
							<i class="i-twitter"></i>
						</a>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( $author_linkedin ) ) : ?>
					<div class="author-bio__share-item">
						<a target="_blank" title="Linkedin" href="<?php echo wp_kses_post( $author_linkedin );?>">
							<i class="i-linkedin"></i>
						</a>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( $author_facebook ) ) : ?>
					<div class="author-bio__share-item">
						<a target="_blank" title="Facebook" href="<?php echo wp_kses_post( $author_facebook );?>">
							<i class="i-facebook"></i>
						</a>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( $author_email ) ) : ?>
					<div class="author-bio__share-item">
						<a target="_blank" title="Contato" href="mailto:<?php echo wp_kses_post( $author_email );?>">
							<i class="i-mail"></i>
						</a>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( $author_github ) ) : ?>
					<div class="author-bio__share-item">
						<a target="_blank" title="Github" href="<?php echo wp_kses_post( $author_github );?>">
							<i class="i-github"></i>
						</a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
</div>

<?php restore_current_blog(); ?>

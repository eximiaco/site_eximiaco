<?php
/**
 * The post list.
 *
 * @package WordPress
 * @subpackage ElemarJr
 * @since 0.1.0
 * @version 0.1.0
 */

$url = get_permalink( get_option( 'page_for_posts' ) );
$url_thinking = get_permalink( get_page_by_path( 'thinking' ) );

// Get current blog extension.
switch ( get_current_blog_id() ) {
    case 3:
        $site_extension = 'Ms';
        break;
    case 2:
        $site_extension = 'Tech';
        break;
	default:
        $site_extension = 'Co';
}
?>
<div class="breadcrumb--wrapper">
	<div class="container">
		<h3 class="breadcrumb--title"><?php echo __( 'Our <b>contents</b>', 'elemarjr' ); ?></h3>

		<ol class="breadcrumb" itemtype="http://schema.org/BreadcrumbList">
			<li class="breadcrumb--item" itemscope itemtype="http://schema.org/ListItem" itemprop="itemListElement">
				<a class="breadcrumb--link" href="<?php echo esc_url( get_home_url() ); ?>" itemprop="item">
					<span itemprop="name"><?php esc_attr_e( $site_extension ); ?></span>
				</a>
				<meta itemprop="position" content="1" />
			</li>
			<li class="breadcrumb--item" itemscope itemtype="http://schema.org/ListItem" itemprop="itemListElement">
				<a class="breadcrumb--link" href="<?php echo esc_url( $url_thinking ); ?>" itemprop="item">
					<span itemprop="name"><?php esc_attr_e( 'Thinking', 'elemarjr' ); ?></span>
				</a>
				<meta itemprop="position" content="1" />
			</li>
			<?php if ( get_post_type() === 'post' ) :
				$url = get_post_type_archive_link( 'post' ); ?>
				<li class="breadcrumb--item" itemscope itemtype="http://schema.org/ListItem" itemprop="itemListElement">
					<a class="breadcrumb--link" href="<?php echo esc_url( $url ); ?>" itemprop="item">
						<span itemprop="name"><?php esc_attr_e( 'Blog', 'elemarjr' ); ?></span>
					</a>
					<meta itemprop="position" content="1" />
				</li>
			<?php elseif ( get_post_type() === 'bliki' ) :
				$url = get_post_type_archive_link( 'post' ); ?>
				<li class="breadcrumb--item" itemscope itemtype="http://schema.org/ListItem" itemprop="itemListElement">
					<a class="breadcrumb--link" href="<?php echo esc_url( $url ); ?>" itemprop="item">
						<span itemprop="name"><?php esc_attr_e( 'Bliki', 'elemarjr' ); ?></span>
					</a>
					<meta itemprop="position" content="1" />
				</li>
			<?php endif; ?>
			<?php if ( is_search() ) : ?>
				<li class="breadcrumb--item" itemscope itemtype="http://schema.org/ListItem" itemprop="itemListElement">
					<a class="breadcrumb--link" href="<?php echo esc_url( get_search_link( get_search_query() ) ); ?>" itemprop="item">
						<span itemprop="name">
							<?php
								/* translators: search results */
								echo esc_html( sprintf( __( 'Search Results for &#8220;%s&#8221;', 'elemarjr' ), get_search_query() ) );
							?>
						</span>
					</a>
					<meta itemprop="position" content="1" />
				</li>
			<?php endif;
			$paged = get_query_var( 'paged' );
			if ( $paged ) :
				$paged_url = add_query_arg( 'paged', $paged, $url );
				?>
				<li class="breadcrumb--item" itemscope itemtype="http://schema.org/ListItem" itemprop="itemListElement">
					<a class="breadcrumb--link" href="<?php echo esc_url( $paged_url ); ?>" itemprop="item">
						<span itemprop="name">
							<?php
								/* translators: page number */
								echo esc_html( sprintf( __( 'Page %s' ), $paged ) );
							?>
						</span>
					</a>
					<meta itemprop="position" content="2" />
				</li>
			<?php endif; ?>
		</ol>
	</div>
</div>

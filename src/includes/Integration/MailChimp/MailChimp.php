<?php
/**
 * MailChimp class
 *
 * @package Aztec
 */

namespace Aztec\Integration\MailChimp;

use Aztec\Base;

/**
 * Integration with MailChimp
 */
class MailChimp extends Base {

	/**
	 * RSS URL.
	 *
	 * @var string
	 */
	public $rss_url = MAILCHIMP_RSS_URL;

	/**
	 * Init.
	 */
	public function init() {
		add_action( 'admin_menu', $this->callback( 'create_menu' ) );
		add_action(  'transition_post_status', $this->callback('update_post'), 10, 3 );
	}

	/**
	 * Add submenu page to the Tools main menu.
	 */
	public function create_menu() {
		if ( get_network()->site_id !== get_current_blog_id() ) {
			return;
		}

		//create new top-level menu
		add_management_page(
			__( 'Sync newsletter', 'elemarjr' ),
			__( 'Sync newsletter', 'elemarjr' ),
			'manage_options',
			'sync-newsletter',
			array( $this, 'display_submenu_page' ),
			6
		);
	}

	/**
	 * Display admin custom page.
	 */
	public function display_submenu_page() {
		echo wp_kses_post( sprintf( '<div class="wrap">
				<h1>%s</h1>
				%s
				<p>%s</p>
			</div>',
			esc_attr__( 'Sync newsletter', 'elemarjr' ),
			$this->sync_newsletter(),
			esc_attr__( 'Synchronization of newsletters with MailChimp.', 'elemarjr' )
		) );
	}

	/**
	 * Make sync with newsletter MailChimp RSS.
	 */
	public function sync_newsletter() {
		// Get a SimplePie feed object from the specified feed source.
		$rss = fetch_feed( $this->rss_url );
		$maxitems = 0;

		if ( ! is_wp_error( $rss ) ) :
			$maxitems = $rss->get_item_quantity();
			$rss_items = $rss->get_items( 0, $maxitems );
		endif;

		if ( 0 === $maxitems ) {
			return $this->notice_error();
		} else {
			$check_post = $this->get_newsletters();
			$itens_insert = array();
			$itens_delete = array();

			// Process RSS feed.
			foreach ( $rss_items as $item ) {
				$post_link = esc_url( $item->get_permalink() );
				// Check if post exists into database.
				if ( array_key_exists( $post_link, $check_post ) ) {
					unset( $check_post[ $post_link ] );
					continue;
				}

				$post_title = esc_html( $item->get_title() );
				$date_stamp = strtotime( $item->get_date() );
				$post_date  = date( 'Y-m-d H:i:s', $date_stamp );

				$result = $this->insert_new_post( $post_title, $post_link, $post_date );
				if ( false === $result ) {
					return $this->notice_error();
				}

				$itens_insert[] = sprintf( '<li><a href="%s" target="_blank">%s</a></li>',
					$post_link,
					$post_title
				);
			}

			// Remove RSS in the newsletters post type.
			foreach ( $check_post as $key => $post ) {
				$itens_delete[] = "<li>{$post}</li>";
				$this->remove_newsletter( $key );
			}
		}

		// Create feedback messages about sync.
		$message = '';

		// If have new newsletters .
		if ( 0 !== count( $itens_insert ) ) {
			$message .= sprintf( '<h4>%s<h4><ul>%s<ul>', __( 'New newsletters inserted:', 'elemarjr' ), implode( $itens_insert ) );
		}

		// If have removed newsletters.
		if ( 0 !== count( $itens_delete ) ) {
			$message .= sprintf( '<h4>%s<h4><ul>%s<ul>', __( 'Newsletters removed:', 'elemarjr' ), implode( $itens_delete ) );
		}

		// If no new changes.
		if ( '' === $message ) {
			$message .= sprintf( '<h4>%s<h4>', __( 'No new changes.', 'elemarjr' ) );
		}

		return $this->notice_success( $message );
	}

	/**
	 * Insert or update a new post.
	 *
	 * @param string $post_title The post title. Default empty.
	 * @param string $post_content The post content. Default empty.
	 * @param string $post_date The date of the post. Default is the current time.
	 *
	 * @return int|boolean
	 */
	public function insert_new_post( $post_title, $post_link, $post_date ) {
		if ( $post_id = wp_insert_post( array (
			'post_type'      => 'newsletter',
			'post_title'     => $post_title,
			'post_content'   => $post_link,
			'post_date'      => $post_date,
			'post_status'    => 'draft',
			'comment_status' => 'closed',
			'ping_status'    => 'closed',
		) ) ) {
			return $post_id;
		}
		return false;
	}

	/**
	 * Handle the post's publication date.
	 *
	 * @param string $new_status Post new publish status.
	 * @param string $old_status Post old publish status.
	 * @param WP_Post $post Post updated.
	 */
	public function update_post( $new_status, $old_status, $post )
	{
		if ( $post->post_type !== 'newsletter' || $old_status !== 'draft'  ||  $new_status !== 'publish' || $post->post_date_gmt !== $post->post_modified_gmt ) {
			return;
		}

		$revisions = wp_get_post_revisions( $post->ID );

		$oldest = NULL;

		foreach ( $revisions as $revision ) {
			$oldest = $revision->ID;
		}

		$previousdate = get_the_date( 'Y-m-d H:i:s', $oldest );

		wp_update_post(
			array (
				'ID'            => $post->ID,
				'post_date'     => $previousdate,
				'post_date_gmt' => get_gmt_from_date( $previousdate )
			)
		);
	}

	/**
	 * Return posts from post type newsletter from database.
	 *
	 * @return array $check_posts
	 */
	public function get_newsletters() {
		$check_posts = array();

		// Get all current posts_type newsletter in the database.
		$posts_in_database = get_posts( array(
			'numberposts' => -1,
			'post_type'   => 'newsletter',
			'post_status' => array('publish', 'draft' )
		) );

		foreach ( $posts_in_database as $post ) {
			$check_posts[$post->post_content] = $post->post_title;
		}

		return $check_posts;
	}

	/**
	 * Remove posts from post type newsletter.
	 *
	 * @return int $post_content
	 */
	public function remove_newsletter( $post_content ) {
		global $wpdb;

		// Get all current posts_type newsletter in the database.
		$result = $wpdb->get_results( "SELECT ID FROM wp_posts WHERE post_content = '{$post_content}' AND post_type = 'newsletter' LIMIT 1" );

		if ( is_wp_error( $result ) ) {
			return;
		}

		foreach ( $result as $post ) {
			wp_delete_post( $post->ID );
			return true;
		}
	}

	/**
	 * Return a success sync message.
	 */
	public function notice_success( $itens = '' ) {
		$class = 'notice notice-success is-dismissible';
		$message = __( 'Sync completed successfully.', 'elemarjr' );
		return sprintf( '<div class="%1$s"><p>%2$s</p>%3$s</div>', esc_attr( $class ), esc_html( $message ), wp_kses_post( $itens ) );
	}

	/**
	 * Return a error sync message.
	 */
	public function notice_error() {
		$class = 'notice notice-error';
		$message = __( 'An error occurred during synchronization.', 'elemarjr' );
		return sprintf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
	}
}

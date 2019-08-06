<?php
/**
 * The post query.
 *
 * @package WordPress
 * @subpackage AztecWpDevEnv
 * @since 0.1.0
 * @version 0.1.0
 */

namespace Aztec\Query;

use WP_Query;
use Aztec\Base;

/**
 * The post query.
 */
class PostNav extends Base {
	/**
	 * Init.
	 */
	public function init() {
		add_filter( 'get_previous_post_join', array( $this, 'post_join' ), 10, 5 );
		add_filter( 'get_next_post_join', array( $this, 'post_join' ), 10, 5 );

		add_filter( 'get_previous_post_where', array( $this, 'previous_post_where' ), 10, 5 );
		add_filter( 'get_next_post_where', array( $this, 'next_post_where' ), 10, 5 );

		add_filter( 'get_previous_post_sort', array( $this, 'post_sort' ), 10, 3 );
		add_filter( 'get_next_post_sort', array( $this, 'post_sort' ), 10, 3 );
	}

	/**
	 * Check if the post is no private.
	 *
	 * @param  \WP_Post $post The current post.
	 * @return boolean
	 */
	private function is_private_post( $post ) {
		return 'private' == get_post_status( $post );
	}

	/**
	 * Change INNER JOIN on `get_adjacent_post()` function.
	 *
	 * @param  string   $join Current join.
	 * @param  boolean  $in_same_term Include posts by term.
	 * @param  array    $excluded_terms Remove posts by array of terms.
	 * @param  string   $taxonomy Post taxonomy.
	 * @param  \WP_Post $post Current post.
	 * @return string
	 */
	public function post_join( $join, $in_same_term, $excluded_terms, $taxonomy, $post ) {
		if ( ! $this->is_private_post( $post ) ) {
			return $join;
		}

		return ' INNER JOIN wp_term_relationships AS tr ON p.ID = tr.object_id INNER JOIN wp_term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
		INNER JOIN wp_termmeta AS tm ON tt.term_id = tm.term_id INNER JOIN wp_term_relationships AS pll_tr ON pll_tr.object_id = p.ID';
	}

	/**
	 * Change WHERE on `get_adjacent_post()` function for previous post.
	 *
	 * @param  string   $where Current where.
	 * @param  boolean  $in_same_term Include posts by term.
	 * @param  array    $excluded_terms Remove posts by array of terms.
	 * @param  string   $taxonomy Post taxonomy.
	 * @param  \WP_Post $post Current post.
	 * @return string
	 */
	public function previous_post_where( $where, $in_same_term, $excluded_terms, $taxonomy, $post ) {
		return $this->post_where( '<', $where, $in_same_term, $excluded_terms, $taxonomy, $post );
	}

	/**
	 * Change WHERE on `get_adjacent_post()` function for next post.
	 *
	 * @param  string   $where Current where.
	 * @param  boolean  $in_same_term Include posts by term.
	 * @param  array    $excluded_terms Remove posts by array of terms.
	 * @param  string   $taxonomy Post taxonomy.
	 * @param  \WP_Post $post Current post.
	 * @return string
	 */
	public function next_post_where( $where, $in_same_term, $excluded_terms, $taxonomy, $post ) {
		return $this->post_where( '>', $where, $in_same_term, $excluded_terms, $taxonomy, $post );
	}

	/**
	 * Change WHERE on `get_adjacent_post()` function.
	 *
	 * @param  string   $op Current operation.
	 * @param  string   $where Current where string.
	 * @param  boolean  $in_same_term Include posts by term.
	 * @param  array    $excluded_terms Remove posts by array of terms.
	 * @param  string   $taxonomy Post taxonomy.
	 * @param  \WP_Post $post Current post.
	 * @return string
	 */
	private function post_where( $op, $where, $in_same_term, $excluded_terms, $taxonomy, $post ) {
		global $wpdb;

		if ( ! $this->is_private_post( $post ) ) {
			return preg_replace( "/p.post_status = 'publish' OR p.post_status = 'private'/", "p.post_status = 'publish'", $where, 1 );
		}

		$term       = get_the_terms( $post, $taxonomy )[0];
		$term_order = get_term_meta( $term->term_id, 'taxonomy_index_order', true );

		// remove post date do `where`.
		$where = preg_replace( '/p.post_date\s[<>]\s\'(.*?)\'\sAND/', '', $where, 1 );

		// adiciona informações necessárias para ordenar por índices e posts.
		$where .= $wpdb->prepare( " AND tm.meta_key = 'taxonomy_index_order' AND ( tm.meta_value {$op} %d OR ( tm.term_id = %d AND p.menu_order {$op} %d ) )", $term_order, $term->term_id, $post->menu_order );

		return $where;
	}

	/**
	 * Change ORDER BY on `get_adjacent_post()` function.
	 *
	 * @param  string   $sort Current sort.
	 * @param  \WP_Post $post Current post.
	 * @param  string   $order Current order.
	 * @return string
	 */
	public function post_sort( $sort, $post, $order ) {
		if ( ! $this->is_private_post( $post ) ) {
			return $sort;
		}

		return " ORDER BY tm.meta_value {$order}, p.menu_order {$order} LIMIT 1";
	}
}

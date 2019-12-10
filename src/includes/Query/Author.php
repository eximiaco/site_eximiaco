<?php
/**
 * The author query.
 *
 * @package WordPress
 * @subpackage AztecWpDevEnv
 * @since 0.1.0
 * @version 0.1.0
 */

namespace Aztec\Query;

use WP_Query;
use Aztec\Base;
use Aztec\Helper\Permalink;

/**
 * The author queries.
 */
class Author extends Base {

	/**
	 * Init.
	 */
	public function init() {
		add_action( 'init', $this->callback( 'author_category_rewrites_init' ) );
	}

	/**
	 * Register the the rewrite rule for user-caategory page.
	 */
	public function author_category_rewrites_init() {

		if ( ! is_plugin_active( 'polylang/polylang.php' ) ) {
			return;
		}

		global $container;
		$languages      = $container->get( Permalink::class )->get_languages_slug();
		$languages_slug = '(' . implode( '|', $languages ) . ')';

		add_rewrite_rule(
			"{$languages_slug}/author/([^/]+)/category/([^/]+)/?$",
			'index.php?lang=$matches[1]&author_name=$matches[2]&category_name=$matches[3]',
			'top'
		);

		add_rewrite_rule(
			"{$languages_slug}/author/([^/]+)/category/([^/]+)/page/?([0-9]{1,})/?$",
			'index.php?lang=$matches[1]&author_name=$matches[2]&category_name=$matches[3]&paged=$matches[4]',
			'top'
		);
	}

	/**
	 * Get author categories
	 *
	 * @param int $author_id Author user id.
	 */
	public function get_author_categories( $author_id ) {
		global $wpdb;

		$lang_id = pll_current_language( 'term_id' );

		$results = $wpdb->get_results(
			$wpdb->prepare(
				"
			SELECT DISTINCT(terms.term_id) as ID, terms.name, terms.slug
			FROM {$wpdb->posts} as posts
			LEFT JOIN {$wpdb->term_relationships} as relationships ON posts.ID = relationships.object_ID
			LEFT JOIN {$wpdb->term_relationships} as tt1 ON posts.ID = tt1.object_id
			LEFT JOIN {$wpdb->term_taxonomy} as tax ON relationships.term_taxonomy_id = tax.term_taxonomy_id
			LEFT JOIN {$wpdb->terms} as terms ON tax.term_id = terms.term_id
			WHERE 1=1 AND (
				posts.post_status = 'publish' AND
				posts.post_author = %s AND
				tax.taxonomy = 'category' AND
				(
					tt1.term_taxonomy_id IN (%s)
				)
			)
			ORDER BY terms.name ASC
		", $author_id, $lang_id
			)
		);

		return $results;
	}
}

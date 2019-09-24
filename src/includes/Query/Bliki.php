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
class Bliki extends Base {
	/**
	 * Init.
	 */
	public function init() {
		add_action( 'pre_get_posts', $this->callback( 'orderby_modified' ) );
	}

	 /**
	  * Esconde posts privados no site
	  *
	  * @param WP_Query $query A consulta que está sendo processada.
	  */
	public function orderby_modified( $query ) {
		if ( is_post_type_archive( 'bliki' ) ) {
			$query->set( 'orderby', 'modified' );
		}
	}
}

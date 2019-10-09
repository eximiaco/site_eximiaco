<?php
/**
 * Init class
 *
 * @package Aztec
 */

namespace Aztec;

use DI\Container;

/**
 * Main theme class
 */
class Kernel {

	/**
	 * The dependency injection container
	 *
	 * @var Container
	 */
	protected $container;

	/**
	 * Initialize the container
	 *
	 * @param Container $container The application container.
	 */
	public function __construct( Container $container ) {
		$this->container = $container;
	}

	/**
	 * Load classes that add or remove hooks
	 */
	public function init() {
		$init_classes = [
			\Aztec\User\Capability::class,

			\Aztec\Setup\Textdomain::class,

			\Aztec\Customize\Colors::class,
			\Aztec\Customize\Head::class,
			\Aztec\Customize\Newsletter::class,
			\Aztec\Customize\Social::class,
			\Aztec\Customize\Banner\Footer\Promotion::class,
			\Aztec\Customize\Banner\SinglePost\Contact::class,
			\Aztec\Customize\Banner\SinglePost\Promotion::class,

			\Aztec\Form\Contact::class,
			\Aztec\Form\Form::class,
			\Aztec\Form\TranslateRequest::class,

			\Aztec\Integration\ACF\ACF::class,
			\Aztec\Integration\ACF\Pages\About::class,
			\Aztec\Integration\ACF\Pages\Contact::class,
			\Aztec\Integration\ACF\Pages\Feature::class,
			\Aztec\Integration\ACF\Pages\HomePage::class,
			\Aztec\Integration\ACF\Pages\NewsletterForm::class,
			\Aztec\Integration\ACF\Pages\Page::class,
			\Aztec\Integration\ACF\Pages\Event::class,
			\Aztec\Integration\ACF\Pages\Resums::class,
			\Aztec\Integration\ACF\Pages\Services::class,
			\Aztec\Integration\ACF\PostType\Lab::class,
			\Aztec\Integration\ACF\PostType\Event::class,
			\Aztec\Integration\ACF\PostType\Service::class,
			\Aztec\Integration\ACF\PostType\Testimonial::class,
			\Aztec\Integration\ACF\Taxonomy\Index::class,

			\Aztec\Integration\AddThis\AddThis::class,

			\Aztec\Integration\Polylang\Polylang::class,

			\Aztec\Integration\YoastSEO\YoastSEO::class,

			\Aztec\Pages\Blog::class,
			\Aztec\Pages\Login::class,
			\Aztec\Pages\Contact::class,
			\Aztec\Pages\NewsletterForm::class,
			\Aztec\Pages\NotFound::class,
			\Aztec\Pages\RestrictedArea::class,
			\Aztec\Pages\Search::class,
			\Aztec\Pages\Single::class,

			\Aztec\Performance\Css::class,

			\Aztec\Query\Bliki::class,
			\Aztec\Query\Post::class,
			\Aztec\Query\PostNav::class,

			\Aztec\PostType\Lab::class,
			\Aztec\PostType\Post::class,
			\Aztec\PostType\Event::class,
			\Aztec\PostType\Service::class,
			\Aztec\PostType\Testimonial::class,
			\Aztec\PostType\Bliki::class,

			\Aztec\Setup\Assets::class,
			\Aztec\Setup\Comments::class,
			\Aztec\Setup\DisableEmoji::class,
			\Aztec\Setup\Head::class,
			\Aztec\Setup\HttpHeader::class,
			\Aztec\Setup\Html5::class,
			\Aztec\Setup\Navigation::class,
			\Aztec\Setup\Rss::class,
			\Aztec\Setup\Template::class,
			\Aztec\Setup\Title::class,
			\Aztec\Setup\Thumbnail::class,

			\Aztec\Shortcode\Twitter::class,
			\Aztec\Shortcode\Veja::class,

			\Aztec\Taxonomy\Serie::class,
			\Aztec\Taxonomy\Index::class,
		];

		foreach ( $init_classes as $class ) {
			$this->container->get( $class )->init();
		}

		$this->forms();
	}

	/**
	 * Define the list of forms of the website
	 */
	public function forms() {
		$this->container->set(
			'forms', [
			\Aztec\Form\Contact::class,
			\Aztec\Form\TranslateRequest::class,
			 ]
		);
	}
}

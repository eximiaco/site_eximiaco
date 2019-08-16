<?php
/**
 * Translate request class
 *
 * @package Aztec
 */

namespace Aztec\Form;

use DI\Container;
use Aztec\Integration\Polylang\Polylang;

/**
 * TranslateRequest form
 */
class TranslateRequest extends Form {

	/**
	 * Define form slug and fields
	 *
	 * @param Container $container The dependency injection container.
	 */
	public function __construct( Container $container ) {
		parent::__construct( $container );

		$this->slug = 'translate-request';
	}

	/**
	 * Init.
	 */
	public function init() {
		add_action( 'customize_register', $this->callback( 'customize' ) );
		add_action( 'init', $this->callback( 'set_fields' ) );
	}

	/**
	 * Set fields.
	 */
	public function set_fields() {
		$this->fields = array(
			'name' => __( 'Name' ),
			'email' => __( 'Email' ),
			'language' => __( 'Language' ),
		);
	}

	/**
	 * Customize.
	 *
	 * @param  \WP_Customize_Manager $wp_customize WP Customize instance.
	 * @return \WP_Customize_Manager|void
	 */
	public function customize( \WP_Customize_Manager $wp_customize ) {
		if ( ! $this->container->get( Polylang::class )->is_active() ) {
			return $wp_customize;
		}

		$section_id = $this->get_theme_mod_section_id();
		$wp_customize->add_section(
			$section_id, array(
			'title' => __( 'Translate Request', 'elemarjr' ),
			'priority' => 190,
			)
		);

		foreach ( PLL()->model->get_languages_list() as $lang ) {
			$email_id = $section_id . '_' . $lang->slug . '_email';
			$wp_customize->add_setting(
				$email_id, array(
				'default' => '',
				)
			);
			$wp_customize->add_control(
				$email_id, array(
				/* translators: %s: website locale */
				'label' => sprintf( __( 'Email that receives the request - (%s)', 'elemarjr' ), $lang->locale ),
				'section' => $section_id,
				'type' => 'text',
				)
			);

			$subject_id = $section_id . '_' . $lang->slug . '_subject';
			$wp_customize->add_setting(
				$subject_id, array(
				'default' => '',
				)
			);
			$wp_customize->add_control(
				$subject_id, array(
				/* translators: %s: locale */
				'label' => sprintf( __( 'Email Subject - (%s)', 'elemarjr' ), $lang->locale ),
				'section' => $section_id,
				'type' => 'text',
				)
			);

			$link_read_id = $section_id . '_' . $lang->slug . '_link_read';
			$wp_customize->add_setting(
				$link_read_id, array(
				'default' => '',
				)
			);
			$wp_customize->add_control(
				$link_read_id, array(
				/* translators: %s: locale */
				'label' => sprintf( __( 'Read link text - (%s)', 'elemarjr' ), $lang->locale ),
				'section' => $section_id,
				'type' => 'text',
				)
			);

			$link_request_id = $section_id . '_' . $lang->slug . '_link_request';
			$wp_customize->add_setting(
				$link_request_id, array(
				'default' => '',
				)
			);
			$wp_customize->add_control(
				$link_request_id, array(
				/* translators: %s: locale */
				'label' => sprintf( __( 'Translation request link text - (%s)', 'elemarjr' ), $lang->locale ),
				'section' => $section_id,
				'type' => 'text',
				)
			);

			$form_message_id = $section_id . '_' . $lang->slug . '_form_message';
			$wp_customize->add_setting(
				$form_message_id, array(
				'default' => '',
				)
			);
			$wp_customize->add_control(
				$form_message_id, array(
				/* translators: %s: locale */
				'label' => sprintf( __( 'Form Message - (%s)', 'elemarjr' ), $lang->locale ),
				'section' => $section_id,
				'type' => 'textarea',
				)
			);

			$form_input_name_id = $section_id . '_' . $lang->slug . '_form_input_name';
			$wp_customize->add_setting(
				$form_input_name_id, array(
				'default' => '',
				)
			);
			$wp_customize->add_control(
				$form_input_name_id, array(
				/* translators: %s: locale */
				'label' => sprintf( __( 'Name field - (%s)', 'elemarjr' ), $lang->locale ),
				'section' => $section_id,
				'type' => 'text',
				)
			);

			$form_input_email_id = $section_id . '_' . $lang->slug . '_form_input_email';
			$wp_customize->add_setting(
				$form_input_email_id, array(
				'default' => '',
				)
			);
			$wp_customize->add_control(
				$form_input_email_id, array(
				/* translators: %s: locale */
				'label' => sprintf( __( 'Email field - (%s)', 'elemarjr' ), $lang->locale ),
				'section' => $section_id,
				'type' => 'text',
				)
			);

			$form_btn_submit_id = $section_id . '_' . $lang->slug . '_form_btn_submit';
			$wp_customize->add_setting(
				$form_btn_submit_id, array(
				'default' => '',
				)
			);
			$wp_customize->add_control(
				$form_btn_submit_id, array(
				/* translators: %s: locale */
				'label' => sprintf( __( 'Submit Button - (%s)', 'elemarjr' ), $lang->locale ),
				'section' => $section_id,
				'type' => 'text',
				)
			);

			$form_feedback_message_success_id = $section_id . '_' . $lang->slug . '_form_feedback_message_success';
			$wp_customize->add_setting(
				$form_feedback_message_success_id, array(
				'default' => '',
				)
			);
			$wp_customize->add_control(
				$form_feedback_message_success_id, array(
				/* translators: %s: locale */
				'label' => sprintf( __( 'Success Feedback Message - (%s)', 'elemarjr' ), $lang->locale ),
				'section' => $section_id,
				'type' => 'textarea',
				)
			);

			$form_feedback_message_error_id = $section_id . '_' . $lang->slug . '_form_feedback_message_error';
			$wp_customize->add_setting(
				$form_feedback_message_error_id, array(
				'default' => '',
				)
			);
			$wp_customize->add_control(
				$form_feedback_message_error_id, array(
				/* translators: %s: locale */
				'label' => sprintf( __( 'Error Feedback Message - (%s)', 'elemarjr' ), $lang->locale ),
				'section' => $section_id,
				'type' => 'textarea',
				)
			);
		}
	}

	/**
	 * Get mod section id.
	 */
	public function get_theme_mod_section_id() {
		return $this->slug;
	}

	/**
	 * Get mod control id.
	 *
	 * @param  \PLL_Language $lang The language.
	 * @param  string        $name The control name.
	 * @return string
	 */
	public function get_theme_mod_control_id( \PLL_Language $lang, $name ) {
		return $this->get_theme_mod_section_id() . '_' . $lang->slug . '_' . $name;
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \Aztec\Form\Form::spam_parameters()
	 */
	public function spam_parameters() {
		$params = parent::spam_parameters();
		$values = $this->get_values();

		$params['comment_author']       = $values['name'];
		$params['comment_author_email'] = $values['email'];

		return $params;
	}
}

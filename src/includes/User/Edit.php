<?php
/**
 * Edit user.
 *
 * @package Aztec
 */

namespace Aztec\User;

use Aztec\Base;

/**
 * Edit user.
 */
class Edit extends Base {

	/**
	 * Add hooks
	 */
	public function init() {
		add_action( 'init', $this->callback( 'read_private_posts' ) );

		// Adiciona o campo personalizado para upload de imagen no perfil de usuário no wp-admin.
		// Adiciona os script js.
		add_action( 'admin_enqueue_scripts', $this->callback( 'add_profile_upload_scripts' ) );

		// Exibe os campos personalizados no formulário do admin.
		add_action( 'show_user_profile', $this->callback( 'extra_profile_fields' ) );
		add_action( 'edit_user_profile', $this->callback( 'extra_profile_fields' ) );
		add_action( 'user_new_form', $this->callback( 'extra_profile_fields' ) );

		// Update dos dados.
		add_action( 'profile_update', $this->callback( 'profile_update' ) );
		add_action( 'user_register', $this->callback( 'profile_update' ) );
	}

	/**
	 * Adicionado capacidade para todos os usuários visualizar posts privados.
	 */
	public function read_private_posts() {
		wp_enqueue_editor();
		wp_enqueue_script(
			'edit-editor-control',
			get_template_directory_uri() . '/assets/js/admin/edit-editor-control.js',
			array(
				'editor',
			),
			false,
			true
		);
	}

	/**
	 * Adiciona o js para upload da imagem de perfil do usuário
	 */
	public function add_profile_upload_scripts() {
		wp_enqueue_media();
		wp_enqueue_script( 'uploader', get_stylesheet_directory_uri() . '/assets/js/admin/avatar-upload.js', array( 'jquery' ), false, true );
	}

	/**
	 * Adiciona o novo campo no formulário do perfil de usuário no admin
	 *
	 * @param \WP_user $user WordPress user.
	 */
	public function extra_profile_fields( $user ) {

		$profile_pic = get_user_meta( $user->ID, 'pic', true );

		if ( ! empty( $profile_pic ) ) {
			$image = wp_get_attachment_image_src( $profile_pic, 'thumbnail' );
		} ?>
		<table class="form-table fh-profile-upload-options">
			<tr>
				<th>
					<label for="image"><?php _e( 'Main Profile Image', 'elemarjr' ); ?></label>
				</th>
				<td>
					<p><img id="profile-img" src="<?php echo ( ! empty( $profile_pic ) ? $image[0] : '' ); ?>" style="<?php echo ( empty( $profile_pic ) ? 'display:none;' : '' ); ?> max-width: 100px; max-height: 100px;" /></p>
					<p><input type="button" data-id="image_id" data-src="profile-img" class="button profile-image" name="image" id="profile-image" value="Upload" /></p>
					<input type="hidden" class="button" name="image_id" id="image_id" value="<?php echo ! empty( $profile_pic ) ? $profile_pic : ''; ?>" />
				</td>
			</tr>
		</table>
		<?php
	}

	/**
	 * Update dos dados personalizados
	 *
	 * @param int $user_id user, author id.
	 */
	public function profile_update( $user_id ) {
		if ( current_user_can( 'edit_users' ) ) {
			$profile_pic = ( empty( $_POST['image_id'] ) ? '' : $_POST['image_id'] );
			update_user_meta( $user_id, 'pic', $profile_pic );
		}
	}
}

<?php

function fixar_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}
add_filter( 'comment_form_fields', 'fixar_move_comment_field_to_bottom' );


function fixar_add_social_fields( $user ) {
?>
	<h3><?php esc_attr_e('Social Information', 'fixar'); ?></h3>

	<table class="form-table">
		<tr>
			<th>
				<label for="address"><?php esc_attr_e('Facebook', 'fixar'); ?>
			</label></th>
			<td>
				<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_attr_e('Please enter your account address. (https://www.facebook.com/)', 'fixar'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="address"><?php esc_attr_e('Twitter', 'fixar'); ?>
			</label></th>
			<td>
				<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_attr_e('Please enter your account address. (https://twitter.com/)', 'fixar'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="address"><?php esc_attr_e('Google+', 'fixar'); ?>
			</label></th>
			<td>
				<input type="text" name="google" id="google" value="<?php echo esc_attr( get_the_author_meta( 'google', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_attr_e('Please enter your account address. (https://plus.google.com/)', 'fixar'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="address"><?php esc_attr_e('Pinterest', 'fixar'); ?>
			</label></th>
			<td>
				<input type="text" name="pinterest" id="pinterest" value="<?php echo esc_attr( get_the_author_meta( 'pinterest', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_attr_e('Please enter your account address. (https://www.pinterest.com/)', 'fixar'); ?></span>
			</td>
		</tr>
	</table>
<?php }

function fixar_save_social_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return FALSE;

	update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
	update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
	update_user_meta( $user_id, 'google', $_POST['google'] );
	update_user_meta( $user_id, 'pinterest', $_POST['pinterest'] );
}

add_action( 'show_user_profile', 'fixar_add_social_fields' );
add_action( 'edit_user_profile', 'fixar_add_social_fields' );

add_action( 'personal_options_update', 'fixar_save_social_fields' );
add_action( 'edit_user_profile_update', 'fixar_save_social_fields' );

?>
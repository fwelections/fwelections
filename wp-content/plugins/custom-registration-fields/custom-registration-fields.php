<?php
/*
Plugin Name: Custom Profile field as a Registration Field
Plugin URI: http://blog.ashfame.com/2010/11/add-custom-field-registration-wordpress/
Description: Sample plugin for adding a custom profile field to WordPress and on the registration page
Author: Ashfame
Version: 0.1
Author URI: http://blog.ashfame.com/
*/

/**
 * Add additional custom field
 */

add_action ( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action ( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields ( $user )
{
?>
	<h3>Extra profile information</h3>
	<table class="form-table">
		
                <tr>
                    <th><label for="organization"><?php echo dg_get_organization_title(); ?></label></th>
			<td>
				<input type="text" name="organization" id="organization" value="<?php echo esc_attr( get_the_author_meta( 'author_organization', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"></span>
			</td>
		</tr>
                
                <tr>
                    <th><label for="country"><?php echo dg_get_country_title(); ?></label></th>
			<td>
                            <?php 
                            
                            $countries = dg_get_countries_list();
                            
                            ?>
                            <select id="country" name="country">
                            <?php
                            
                            $country_code = esc_attr( get_the_author_meta( 'author_country', $user->ID ));
                            
                            if ($country_code == "") {
                                $country_code = -1;
                            }
                            
                            if ($country_code == $country['ID'])
                                echo '<option value="-1" selected>'.dg_get_none_country_text().'</option>';
                                else echo '<option value="-1" >'.dg_get_none_country_text().'</option>';
                            
                            foreach ($countries as $country) {
                                
                                if ($country_code == $country['ID'])
                                echo '<option value="'.$country['ID'].'" selected>'.$country['post_title'].'</option>';
                                else echo '<option value="'.$country['ID'].'">'.$country['post_title'].'</option>';
                            }
                            
                            
                            ?>
                                
                            </select>
				<span class="description"></span>
			</td>
		</tr>
                <tr>
                    <th><label for="city"><?php echo dg_get_city_title(); ?></label></th>
			<td>
				<input type="text" name="city" id="city" value="<?php echo esc_attr( get_the_author_meta( 'author_city', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"></span>
			</td>
		</tr>
	</table>
<?php
}

add_action ( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action ( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id )
{
	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;
	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	
        update_usermeta( $user_id, 'author_organization', $_POST['organization'] );
        update_usermeta( $user_id, 'author_country', $_POST['country'] );
        update_usermeta( $user_id, 'author_city', $_POST['city'] );
}

/**
 * Add cutom field to registration form
 */

add_action('register_form','show_first_name_field');
add_action('register_post','check_fields',10,3);
add_action('user_register', 'register_extra_fields');

function show_first_name_field()
{
?>
	<p>
	<label>Twitter<br/>
	<input id="twitter" type="text" tabindex="30" size="25" value="<?php echo $_POST['twitter']; ?>" name="twitter" />
	</label>
	</p>
<?php
}

function check_fields ( $login, $email, $errors )
{
	global $twitter;
	if ( $_POST['twitter'] == '' )
	{
		$errors->add( 'empty_realname', "<strong>ERROR</strong>: Please Enter your twitter handle" );
	}
	else
	{
		$twitter = $_POST['twitter'];
	}
}

function register_extra_fields ( $user_id, $password = "", $meta = array() )
{
	update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
}

?>
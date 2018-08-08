<?php

/*
  Plugin Name: Custom Registration
  Plugin URI: http://code.tutsplus.com
  Description: Updates user rating based on number of posts.
  Version: 1.0
  Author: Agbonghama Collins
  Author URI: http://tech4sky.com
 */

function custom_registration_function() {
    if (isset($_POST['submit'])) {
        registration_validation(
        $_POST['username'],
        $_POST['password'],
        $_POST['email'],
        $_POST['website'],
        $_POST['fname'],
        $_POST['lname'],
        $_POST['nickname'],
        $_POST['bio']
		);

        // дезинформировать ввод формы пользователя
        global $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio;
        $username	= 	sanitize_user($_POST['username']);
        $password 	= 	esc_attr($_POST['password']);
        $email 		= 	sanitize_email($_POST['email']);
        $website 	= 	esc_url($_POST['website']);
        $first_name = 	sanitize_text_field($_POST['fname']);
        $last_name 	= 	sanitize_text_field($_POST['lname']);
        $nickname 	= 	sanitize_text_field($_POST['nickname']);
        $bio 		= 	esc_textarea($_POST['bio']);

        // запрашивает @function complete_registration, чтобы создать пользователя
        // только когда не найден WP_error
        complete_registration(
        $username,
        $password,
        $email,
        $website,
        $first_name,
        $last_name,
        $nickname,
        $bio
		);
    }

    registration_form(
    	$username,
        $password,
        $email,
        $website,
        $first_name,
        $last_name,
        $nickname,
        $bio
		);
}

function registration_form( $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio ) {

    echo '
    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post" id="form-reg">
	<div>
	<label for="username">Username <strong>*</strong></label>
	<input type="text" name="username" value="' . (isset($_POST['username']) ? $username : null) . '">
	</div>
	
	<div>
	<label for="password">Password <strong>*</strong></label>
	<input type="password" name="password" value="' . (isset($_POST['password']) ? $password : null) . '">
	</div>
	
	<div>
	<label for="email">Email <strong>*</strong></label>
	<input type="text" name="email" value="' . (isset($_POST['email']) ? $email : null) . '">
	</div>
	
	<div>
	<label for="website">Website</label>
	<input type="text" name="website" value="' . (isset($_POST['website']) ? $website : null) . '">
	</div>
	
	<div>
	<label for="firstname">First Name</label>
	<input type="text" name="fname" value="' . (isset($_POST['fname']) ? $first_name : null) . '">
	</div>
	
	<div>
	<label for="website">Last Name</label>
	<input type="text" name="lname" value="' . (isset($_POST['lname']) ? $last_name : null) . '">
	</div>
	
	<div>
	<label for="nickname">Nickname</label>
	<input type="text" name="nickname" value="' . (isset($_POST['nickname']) ? $nickname : null) . '">
	</div>
	
	<div>
	<label for="bio">About / Bio</label>
	<textarea name="bio">' . (isset($_POST['bio']) ? $bio : null) . '</textarea>
	</div>
	<input type="submit" name="submit" value="Register"/>
	</form>
	';
}

function registration_validation( $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio )  {
    global $reg_errors;
    $reg_errors = new WP_Error;

    if ( empty( $username ) || empty( $password ) || empty( $email ) ) {
        $reg_errors->add('field', 'Поле обязательной формы отсутствует');
    }

    if ( strlen( $username ) < 4 ) {
        $reg_errors->add('username_length', 'Имя пользователя слишком короткое. Требуется не менее 4 символов');
    }

    if ( username_exists( $username ) )
        $reg_errors->add('user_name', 'Sorry, это имя пользователя уже существует!');

    if ( !validate_username( $username ) ) {
        $reg_errors->add('username_invalid', 'Извините, введенное вами имя пользователя недопустимо');
    }

    if ( strlen( $password ) < 5 ) {
        $reg_errors->add('password', 'Длина пароля должна быть больше 5');
    }

    if ( !is_email( $email ) ) {
        $reg_errors->add('email_invalid', 'Email не является допустимым');
    }

    if ( email_exists( $email ) ) {
        $reg_errors->add('email', 'Этот электронный адрес уже занят');
    }
    
    if ( !empty( $website ) ) {
        if ( !filter_var($website, FILTER_VALIDATE_URL) ) {
            $reg_errors->add('website', 'Веб-сайт не является допустимым URL-адресом');
        }
    }

    if ( is_wp_error( $reg_errors ) ) {

        foreach ( $reg_errors->get_error_messages() as $error ) {
            echo '<div>';
            echo '<strong>ERROR</strong>:';
            echo $error . '<br/>';

            echo '</div>';
        }
    }
}

function complete_registration() {
    global $reg_errors, $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio;
    if ( count($reg_errors->get_error_messages()) < 1 ) {
        $userdata = array(
        'user_login'	=> 	$username,
        'user_email' 	=> 	$email,
        'user_pass' 	=> 	$password,
        'user_url' 		=> 	$website,
        'first_name' 	=> 	$first_name,
        'last_name' 	=> 	$last_name,
        'nickname' 		=> 	$nickname,
        'description' 	=> 	$bio,
		);
        $user = wp_insert_user( $userdata );
        echo 'Registration complete. Goto <a href="' . get_site_url() . '/wp-login.php">login page</a>.';
        echo '<script>document.getElementById("form-reg").reset();</script>';
	}
}

// Зарегистрируйте новый короткий код: [cr_custom_registration]
add_shortcode('cr_custom_registration', 'custom_registration_shortcode');

// Функция обратного вызова, которая заменит [book]
function custom_registration_shortcode() {
    ob_start();
    custom_registration_function();
    return ob_get_clean();
}


//<?php custom_registration_function(); ?>
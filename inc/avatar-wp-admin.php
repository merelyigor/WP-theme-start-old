<?php
/**
 * the function of adding your avatar to the admin panel for default display
 * ---------------------------------------------------------------------------------------------------------------------
 */
add_filter('avatar_defaults', function ($avatar_defaults) {
    $myavatar = get_template_directory_uri() . '/avatar-user-img/ava.png';
    $avatar_defaults[$myavatar] = "The name of this avatar in the admin when choosing avatars";
    return $avatar_defaults;
});


<?php
function admin_assets_url($var_admin_assets = 'secret')
{
    if (isset($_GET['var'])) {
        $secret_key = $_GET['var'];
        setcookie("var_admin_assets", $secret_key, strtotime('+30 days'));
    } else if (isset($_COOKIE['var_admin_assets'])) {
        $secret_key = $_COOKIE['var_admin_assets'];
    } else {
        $secret_key = '';
    }
    if (function_exists('is_log_page'))
        $is_log = true;
    else
        $is_log = false;
    if (is_admin() || $is_log) {
        if ($secret_key !== $var_admin_assets) {
            header("HTTP/1.0 404 Not Found");
            exit;
        }
    }
}



## put this function in a file wp-login.php at the root of WordPress for the correct function of the above function
/*************

function is_log_page()
{
return true;
}

*************/

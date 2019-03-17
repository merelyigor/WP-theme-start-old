<?php
/**
 * Take away JSON array and parser it into layout
 * ---------------------------------------------------------------------------------------------------------------------
 */
function get_json_decode($url = null)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    $output = curl_exec($ch);
    curl_close($ch);
    if (isset($url))
        return json_decode($output, true);
    else
        return 'вы не задали url';
}
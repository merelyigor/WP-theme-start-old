<?php
/**
 * text translation function via google and customizable static text translation
 * ---------------------------------------------------------------------------------------------------------------------
 */
function static_text($text = 0, $lang_input = null, $lang_uotput = null)
{
    $tis_locale = get_locale(); // https://make.wordpress.org/polyglots/teams/
    if ($lang_input === 'russian')
        $lang_input = 'ru';
    if ($lang_uotput === 'ukr')
        $lang_uotput = 'uk';

    if (isset($lang_input) && isset($lang_uotput))
        return google_translate($text, $lang_input, $lang_uotput);
    elseif ($tis_locale === 'en_US')
        return google_translate($text, 'uk', 'en');
    elseif ($tis_locale === 'el')
        return google_translate($text, 'uk', 'el');
    elseif ($tis_locale === 'ru_RU')
        return google_translate($text, 'ru', 'uk');
    else
        return $text;
}

function google_translate($text, $lang_input, $lang_uotput)
{
    $query_data = array(
        'client' => 'x',
        'q' => $text,
        'sl' => $lang_input,
        'tl' => $lang_uotput
    );
    $filename = 'http://translate.google.ru/translate_a/t';
    $options = array(
        'http' => array(
            'user_agent' => 'Mozilla/5.0 (Windows NT 6.0; rv:26.0) Gecko/20100101 Firefox/26.0',
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'content' => http_build_query($query_data)
        )
    );
    $context = stream_context_create($options);
    $response = file_get_contents($filename, false, $context);
    return json_decode($response);
}
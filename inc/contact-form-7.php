<?php
// удаляет тег 'span' в плагине Contact Form 7
add_filter('wpcf7_form_elements', function ($content) {
	$content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
	return $content;
});

// удаляет тег 'p' в плагине Contact Form 7
define('WPCF7_AUTOP', false);
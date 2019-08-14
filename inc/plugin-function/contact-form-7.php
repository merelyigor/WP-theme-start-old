<?php
// removes the tag 'span' in plugin Contact Form 7
add_filter('wpcf7_form_elements', function ($content) {
	$content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
	return $content;
});

// removes the tag 'p' in plugin Contact Form 7
define('WPCF7_AUTOP', false);
<?php


## remove height & width from images in post content


add_filter('the_content', function ($content) {
    $content = preg_replace("/<iframe.+?src=\"(.+?)\"/Si", '<div class="iframe-container"><iframe src="\1" frameborder="0" allowfullscreen>', $content);
    $content = preg_replace("/<\/iframe>/Si", '</iframe></div>', $content);
    $content = preg_replace('/(width|height)="\d*"/', '', $content);
    return $content;
});

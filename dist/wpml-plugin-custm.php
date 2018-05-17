<?php
/**
 * WPML кастомная кнопка переключения языков
 *  вывод статуса языка на странице для html ---- <html <?php echo ICL_LANGUAGE_CODE ?> class="no-js no-svg">
 * вывод кастомной кнопки переключения языка ---- <?php my_language_switcher() ?>
 * ---------------------------------------------------------------------------------------------------------------------
 */
function my_language_switcher()
{
    $languages = apply_filters('wpml_active_languages', NULL, array('skip_missing' => 0));

    $html = '<div class="languages"><div class="languages-list">';

    if (!empty($languages)) {
        foreach ($languages as $language) {
            if ($language['active']) {
                $html .= '<a class="selected">' . $language['native_name'] .
                    ' <svg><use xlink:href="' . get_template_directory_uri() . '/img/sprite-inline.svg#down-arrow"></use></svg></a>';
            }
        }
        foreach ($languages as $language) {
            if (!$language['active']) {
                $html .= '<a class="" href="' . $language['url'] . '">' . $language['native_name'] . '</a>';
            }
        }
    }

    $html .= '</div></div>';
    echo($html);
}

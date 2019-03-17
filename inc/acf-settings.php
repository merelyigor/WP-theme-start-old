<?php
/**
 * Settings for the plug-in ACF custom fields
 * ---------------------------------------------------------------------------------------------------------------------
 */

/************** ------- Registration key API for maps from Google ------- **************/
add_action('acf/init', function () {
    acf_update_setting('google_api_key', 'The key that will give Google'); // example AIzaSyCrCFYIhuN0oeyVRWpBAbnCJJlQ5mRe0k0
});

/************** - sample map output with field name (map_contacts)
 * <?php $location = get_field('map_contacts');
 * $address = implode(array_slice(explode(',', $location['address']), 0, 3), ',');
 * if( !empty($location) ): ?>
 * <div class="main-section__map" id="map" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>" data-address="<?php echo $address; ?>"></div>
 * <?php endif; ?>
 **************/


/************** ------- Resize images for size in images ACF ------- **************/
function resize_img_acf()
{
    add_image_size('1920x1080', 1920, 1080, true);
    add_image_size('1920x720', 1920, 720, true);
    add_image_size('900x305', 900, 305, true);
    add_image_size('768x600', 768, 600, true);
    add_image_size('641x415', 641, 415, true);
    add_image_size('638x500', 638, 500, true);
    add_image_size('550x415', 550, 415, true);
    add_image_size('370x368', 370, 368, true);
    add_image_size('356x493', 356, 493, true);
    add_image_size('353x353', 353, 353, true);
    add_image_size('200x283', 200, 283, true);
    add_image_size('362x58', 362, 58, true);
    add_image_size('234x58', 234, 58, true);
    add_image_size('265x37', 265, 37, true);
    add_image_size('181x129', 181, 129, true);
    add_image_size('54x50', 54, 50, true);
}

resize_img_acf();


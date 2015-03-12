<?php
/*
Plugin Name: Coupon Popup
Description: Easily create beautiful customizable coupon widgets that can be revealed to increase conversions.
Version: 1.1.0
*/

require_once 'inc/assets.php';
require_once 'inc/attribution.php';
require_once 'inc/settings.php';

class CouponPopup
{
    public static $classPrefix = 'coupon-popup-';
    public static $linkClass = 'coupon-popup-link';
	public static $codeClass = 'coupon-popup-code';
	public static $popupLinkClass = 'coupon-popup-popup-link';
	public static $containerClass = 'coupon-popup-container';
	public static $popupClass = 'coupon-popup-popup';
}

function generate_id($length) {
    $id = '';

    for($i = 0; $i < $length; $i++) {
       $id .= chr(rand(65, 90));
    }

    return $id;
}

function coupon_code($atts) {
	$a = shortcode_atts( array(
        'id' => generate_id(6),
		'title' => 'My Title',
		'description' => '',
		'url' => '',
		'type' => 'code',
		'code' => '',
        'shows_at' => NULL,
		'expires_at' => NULL,
        'time_zone' => 'America/Los_Angeles',
		'image' => '',
        'button' => NULL,
        'hide_button' => 0,
        'theme' => 'base',
        'pop' => 1,
        'reveal' => 0
	), $atts );

    // Change time zone
    $original_time_zone = date_default_timezone_get();
    date_default_timezone_set($a['time_zone']);

    $now = strtotime('now');

    if (isset($a['shows_at'])) {
        $a['show'] = $now >= strtotime($a['shows_at']);
    } else {
        $a['show'] = TRUE;
    }

    if (isset($a['expires_at'])) {
    	$a['expired'] = strtotime($a['expires_at']) <= $now;
    } else {
        $a['expired'] = FALSE;
    }

    // Restore time zone
    date_default_timezone_set($original_time_zone);

    $themes = explode(' ',$a['theme']);
    $folder_theme = 'base'; // default theme
    $style_theme = NULL;    // default style
    if(!empty($themes))
    if(isset($themes[0])&&('' !== $themes[0])){
        $d_path = plugin_dir_path(__FILE__) . 'themes/' . $themes[0];
        if (file_exists($d_path))
        if(is_dir($d_path)){
            $folder_theme = $themes[0];
            if(isset($themes[1])&&('' !== $themes[1])){
                $f_path = $d_path.'/'.$themes[1].'.css';
                if (file_exists($f_path)) {
                    $style_theme = $themes[1];
                }
            }
        }
    }

    // include template
    $html_url = 'themes/'.$folder_theme.'/html.php';
    $coupon = $a;
    $coupon['theme'] = $folder_theme;
    $coupon['style'] = $style_theme;

    // Typecast boolean
    $coupon['reveal'] = 'true' === $coupon['reveal'];
    $coupon['hide_button'] = 'true' === $coupon['hide_button'];

    // Coupon button
    if ($coupon['hide_button']) {
        $coupon['button'] = NULL;
    } else {
        if (!isset($coupon['button'])) {
            if ($coupon['type'] == "code" && !$coupon['reveal']) {
                $coupon['button'] = "Reveal Code";
            } else {
                $coupon['button'] = "Get Deal";
            }
        }
    }

    // Build css classes
    $css_classes = $coupon['type'] .' '. $coupon['theme'] .' '. $coupon['style'];
    $css_classes = $css_classes . ($coupon['show'] ? ' live' : '');
    $css_classes = $css_classes . ($coupon['expired'] ? ' expired' : '');
    $css_classes = $css_classes . ($coupon['reveal'] ? ' revealed' : '');

    // helpers
    $html_data_attributes = 'data-description="'. $coupon['description'] .'" '.
                            'data-image="'. $coupon['image'] .'" '.
                            'data-url="'. $coupon['url'] .'" '.
                            'data-pop="'. $coupon['pop'] .'" '.
                            'data-code="'. $coupon['code'] .'" '.
                            'data-type="'. $coupon['type'] .'" '.
                            'data-theme="'. $coupon['theme'] .'" '.
                            'data-style="'. $coupon['style'] .'" '.
                            'data-classes="'. $css_classes .'"';
    $container_class = CouponPopup::$containerClass .' '. $css_classes;
    $popup_class = CouponPopup::$popupClass;

    if (file_exists(plugin_dir_path(__FILE__) . $html_url)) {
        if ($coupon['show'] && !$coupon['expired']) {
            ob_start();
            include $html_url;
            $template = ob_get_contents();
            ob_end_clean();
        }
    }

    // include styles
    // Always include default style before
    wp_enqueue_style($folder_theme, plugins_url() . '/coupon-popup/' . 'themes/'. $folder_theme .'/default.css');

    // Include custom style if it exists
    $css_url = 'themes/'. $folder_theme .'/'.$style_theme.'.css';
    if (file_exists(plugin_dir_path(__FILE__) . $css_url)) {
        wp_enqueue_style($folder_theme.'_'.$style_theme, plugins_url() . '/coupon-popup/' . 'themes/'.$folder_theme.'/'.$style_theme.'.css');
    }

    return $template;
}

add_shortcode('coupon', 'coupon_code');

add_action('wp_loaded', 'coupon_popup_check_redirect');

function coupon_popup_check_redirect() {
    if (isset($_GET['goto']) && filter_var($_GET['goto'], FILTER_VALIDATE_URL)) {
    	wp_redirect($_GET['goto']);
    }
}
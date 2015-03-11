<?php
add_action('wp_print_scripts', 'ShortCouponScriptsAction');
function ShortCouponScriptsAction()
{
    $plugin_url = plugins_url() . '/coupon-popup/';

	if (!is_admin()) {
		wp_enqueue_script('vex', $plugin_url.'js/vex.js', array('jquery'));
		wp_enqueue_script('coupon-popup',
			$plugin_url.'js/coupon-popup.js');
		wp_localize_script( 'coupon-popup', 'settings', array(
			'containerClass' => CouponPopup::$containerClass,
			'linkClass' => CouponPopup::$linkClass,
			'popupLinkClass' => CouponPopup::$popupLinkClass,
			'popupClass' => CouponPopup::$popupClass,
		));

		wp_enqueue_style('coupon-popup', $plugin_url.'css/coupon-popup.css');
		wp_enqueue_style('vex', $plugin_url.'css/vex.css');
	}
}
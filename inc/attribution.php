<?php

function coupon_popup_add_post_attribution($post) {
    # Only add attribution link if enabled
    if (get_option('add_attribution') == "1") {
        $attribution = '<br /><div class="coupon-popup-attribution"><a href="http://www.sumoshopper.com/coupon-popup" target="_blank">Coupon Popup</a> by <a href="http://www.sumoshopper.com" target="_blank">Sumoshopper</a></div>';
    } else {
        $attribution = "";
    }

    return $post . $attribution;
}

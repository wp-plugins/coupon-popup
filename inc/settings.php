<?php

add_action('admin_menu', 'coupon_popup_create_settings');

function coupon_popup_create_settings() {
    add_options_page("Coupon Popup Settings", "Coupon Popup", 'manage_options', 'coupon-popup-settings', 'coupon_popup_render_settings');
    add_action('admin_init', 'coupon_popup_register_settings');
}

function coupon_popup_register_settings() {
    register_setting('coupon-popup-settings-group', 'add_attribution');
}

function coupon_popup_render_settings() {
    $addAttributionOptionValue = esc_attr(get_option('add_attribution'));

?>

<div class="wrap">
    <h2>Coupon Popup Settings</h2>
    <form method="post" action="options.php">

    <div id="poststuff" class="has-right-sidebar">
        <div id="side-info-column" class="inner-sidebar">
            <div class="postbox">
                <h3 class="hndle"><span>About</span></h3>
                <div class="inside">
                    <p>Easily create beautiful customizable coupon widgets that can be revealed to increase conversions.</p>
                    <p>
                        <a href="https://wordpress.org/plugins/coupon-popup">Plugin Website</a>
                        <br />
                        By <a href="http://www.sumoshopper.com">Sumoshopper</a>
                    </p>
                    <p>Made with &hearts; in Los Angeles</p>
                </div>
            </div>
        </div>
        <div id="post-body" class="has-sidebar">
            <div id="post-body-content" class="has-sidebar-content">
                <div class="postbox">
                    <h3 class="hndle"><span>Options</span></h3>
                    <div class="inside">
                        <p>Help us maintain the plugin and add new features by enabling the attribution link below. We owe ya one!</p>
                        <?php settings_fields('coupon-popup-settings-group'); ?>
                        <?php do_settings_sections('coupon-popup-settings-group'); ?>

                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row">Add Attribution Link</th>
                                    <td>
                                        <label for="add_attribution">
                                            <input type="checkbox" id="add_attribution" name="add_attribution" value="1" <?php echo $addAttributionOptionValue == "1" ? 'checked="checked"' : '' ?>/>
                                            Will be added to the bottom of each post you use the plugin on
                                        </label>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php submit_button(); ?>
        </div>
    </div>
    </form>
</div>

<?php

}
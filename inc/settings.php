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

    <p>This plugin was created by your friends at <a href="http://www.sumoshopper.com">Sumoshopper</a>.<p>
    <p><em>We'd absolutely love you to death if you could enable adding the attribution link by checking the option below. It would go a long way and help us maintain the plugin and add new features!</em></p>

    <form method="post" action="options.php">
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

        <?php submit_button(); ?>

    </form>
</div>

<?php

}
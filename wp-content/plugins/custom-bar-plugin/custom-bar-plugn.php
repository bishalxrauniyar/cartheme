<?php

/**
 * Plugin Name: Custom Bar Plugin
 * Description: A WordPress plugin to display a customizable bar at the header or footer.
 * Version: 1.0
 * Author: BR
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Add settings menu
function cbp_add_menu_page()
{
    add_menu_page('Bar Plugin Settings', 'Bar Plugin', 'manage_options', 'cbp-settings', 'cbp_settings_page');
}
add_action('admin_menu', 'cbp_add_menu_page');

// Settings page content
function cbp_settings_page()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cbp_save_settings'])) {
        update_option('cbp_bar_position', sanitize_text_field($_POST['cbp_bar_position']));
        update_option('cbp_bar_message', sanitize_text_field($_POST['cbp_bar_message']));
        update_option('cbp_button_text', sanitize_text_field($_POST['cbp_button_text']));
        update_option('cbp_button_url', esc_url_raw($_POST['cbp_button_url']));
        update_option('cbp_bg_color', sanitize_hex_color($_POST['cbp_bg_color']));
        update_option('cbp_font_color', sanitize_hex_color($_POST['cbp_font_color']));
        update_option('cbp_show_once', isset($_POST['cbp_show_once']) ? 'yes' : 'no');
    }
?>
    <div class="wrap">
        <h2>Bar Plugin Settings</h2>
        <form method="post">
            <label>Position:</label>
            <select name="cbp_bar_position">
                <option value="header" <?php selected(get_option('cbp_bar_position'), 'header'); ?>>Header</option>
                <option value="footer" <?php selected(get_option('cbp_bar_position'), 'footer'); ?>>Footer</option>
            </select>
            <br><br>
            <label>Message:</label>
            <input type="text" name="cbp_bar_message" value="<?php echo esc_attr(get_option('cbp_bar_message')); ?>">
            <br><br>
            <label>Button Text:</label>
            <input type="text" name="cbp_button_text" value="<?php echo esc_attr(get_option('cbp_button_text')); ?>">
            <br><br>
            <label>Button URL:</label>
            <input type="text" name="cbp_button_url" value="<?php echo esc_attr(get_option('cbp_button_url')); ?>">
            <br><br>
            <label>Background Color:</label>
            <input type="color" name="cbp_bg_color" value="<?php echo esc_attr(get_option('cbp_bg_color', '#000000')); ?>">
            <br><br>
            <label>Font Color:</label>
            <input type="color" name="cbp_font_color" value="<?php echo esc_attr(get_option('cbp_font_color', '#ffffff')); ?>">
            <br><br>
            <label>Show Once:</label>
            <input type="checkbox" name="cbp_show_once" <?php checked(get_option('cbp_show_once'), 'yes'); ?>>
            <br><br>
            <input type="submit" name="cbp_save_settings" value="Save Settings">
        </form>
    </div>
<?php
}

// Display the bar on frontend
function cbp_display_bar()
{
    $position = get_option('cbp_bar_position', 'header');
    $message = get_option('cbp_bar_message', '');
    $button_text = get_option('cbp_button_text', '');
    $button_url = get_option('cbp_button_url', '#');
    $bg_color = get_option('cbp_bg_color', '#000000');
    $font_color = get_option('cbp_font_color', '#ffffff');
    $show_once = get_option('cbp_show_once', 'no');
?>
    <div id="cbp-bar" style="position:fixed; <?php echo $position; ?>:0; left:0; width:100%; background:<?php echo $bg_color; ?>; color:<?php echo $font_color; ?>; padding:10px; text-align:center;">
        <span><?php echo esc_html($message); ?></span>
        <?php if (!empty($button_text)) : ?>
            <a href="<?php echo esc_url($button_url); ?>" style="color:<?php echo $font_color; ?>; padding:5px 10px; background:#fff; margin-left:10px; text-decoration:none;"> <?php echo esc_html($button_text); ?> </a>
        <?php endif; ?>
        <button onclick="this.parentElement.style.display='none'" style="margin-left:10px;">X</button>
    </div>
<?php
    if ($show_once === 'yes') {
        echo "<script>if(localStorage.getItem('cbp_bar_seen')) document.getElementById('cbp-bar').style.display = 'none'; else localStorage.setItem('cbp_bar_seen', 'true');</script>";
    }
}
add_action('wp_footer', 'cbp_display_bar');

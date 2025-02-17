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

// Register activation hook
register_activation_hook(__FILE__, 'cbp_activate');

// Set default options on plugin activation
function cbp_activate()
{
    add_option('cbp_bar_position', 'header');
    add_option('cbp_bar_message', 'Welcome to our site!');
    add_option('cbp_button_text', 'Learn More');
    add_option('cbp_button_url', '#');
    add_option('cbp_bg_color', '#000000');
    add_option('cbp_font_color', '#ffffff');
    add_option('cbp_show_once', 'no');
}

// Add settings menu
function cbp_add_menu_page()
{
    add_menu_page('Bar Plugin Settings', 'Bar Plugin', 'manage_options', 'cbp-settings', 'cbp_settings_page');
}
add_action('admin_menu', 'cbp_add_menu_page');

// Custom sanitization function for hex color
function cbp_sanitize_hex_color($color)
{
    if ('' === $color) {
        return '';
    }
    if (preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color)) {
        return $color;
    }
    return '';
}

// Settings page content
function cbp_settings_page()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cbp_save_settings'])) {
        update_option('cbp_bar_position', sanitize_text_field($_POST['cbp_bar_position']));
        update_option('cbp_bar_message', sanitize_text_field($_POST['cbp_bar_message']));
        update_option('cbp_button_text', sanitize_text_field($_POST['cbp_button_text']));
        update_option('cbp_button_url', esc_url_raw($_POST['cbp_button_url']));
        update_option('cbp_bg_color', cbp_sanitize_hex_color($_POST['cbp_bg_color']));
        update_option('cbp_font_color', cbp_sanitize_hex_color($_POST['cbp_font_color']));
        update_option('cbp_show_once', isset($_POST['cbp_show_once']) ? 'yes' : 'no');

        echo '<div class="notice notice-success is-dismissible"><p>Settings saved successfully!</p></div>';
    }
?>
    <div class="wrap">
        <h2>Bar Plugin Settings</h2>
        <form method="post">
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="cbp_bar_position">Position:</label></th>
                    <td>
                        <select name="cbp_bar_position" id="cbp_bar_position">
                            <option value="header" <?php selected(get_option('cbp_bar_position'), 'header'); ?>>Header</option>
                            <option value="footer" <?php selected(get_option('cbp_bar_position'), 'footer'); ?>>Footer</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="cbp_bar_message">Message:</label></th>
                    <td>
                        <input type="text" name="cbp_bar_message" id="cbp_bar_message" class="regular-text" value="<?php echo esc_attr(get_option('cbp_bar_message')); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="cbp_button_text">Button Text:</label></th>
                    <td>
                        <input type="text" name="cbp_button_text" id="cbp_button_text" class="regular-text" value="<?php echo esc_attr(get_option('cbp_button_text')); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="cbp_button_url">Button URL:</label></th>
                    <td>
                        <input type="text" name="cbp_button_url" id="cbp_button_url" class="regular-text" value="<?php echo esc_attr(get_option('cbp_button_url')); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="cbp_bg_color">Background Color:</label></th>
                    <td>
                        <input type="color" name="cbp_bg_color" id="cbp_bg_color" value="<?php echo esc_attr(get_option('cbp_bg_color', '#000000')); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="cbp_font_color">Font Color:</label></th>
                    <td>
                        <input type="color" name="cbp_font_color" id="cbp_font_color" value="<?php echo esc_attr(get_option('cbp_font_color', '#ffffff')); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="cbp_show_once">Show Once:</label></th>
                    <td>
                        <input type="checkbox" name="cbp_show_once" id="cbp_show_once" <?php checked(get_option('cbp_show_once'), 'yes'); ?>>
                        <span class="description">If checked, the bar will only be shown once per visitor</span>
                    </td>
                </tr>
            </table>
            <p class="submit">
                <input type="submit" name="cbp_save_settings" class="button-primary" value="Save Settings">
            </p>
        </form>
    </div>
<?php
}

// Register the display hooks based on position setting
function cbp_register_display_hooks()
{
    $position = get_option('cbp_bar_position', 'header');
    if ($position === 'header') {
        add_action('wp_head', 'cbp_display_bar');
    } else {
        add_action('wp_footer', 'cbp_display_bar');
    }
}
add_action('wp', 'cbp_register_display_hooks');

// Display the bar on frontend
function cbp_display_bar()
{
    $position = get_option('cbp_bar_position', 'header');
    $css_position = ($position === 'header') ? 'top' : 'bottom';
    $message = get_option('cbp_bar_message', '');
    $button_text = get_option('cbp_button_text', '');
    $button_url = get_option('cbp_button_url', '#');
    $bg_color = get_option('cbp_bg_color', '#000000');
    $font_color = get_option('cbp_font_color', '#ffffff');
    $show_once = get_option('cbp_show_once', 'no');

    // Only proceed if message exists
    if (empty($message)) {
        return;
    }

?>
    <style type="text/css">
        #cbp-bar {
            position: fixed;
            <?php echo $css_position; ?>: 0;
            left: 0;
            width: 100%;
            background-color: <?php echo esc_attr($bg_color); ?>;
            color: <?php echo esc_attr($font_color); ?>;
            padding: 10px;
            text-align: center;
            z-index: 9999;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
        }

        #cbp-bar a.cbp-button {
            display: inline-block;
            margin-left: 10px;
            padding: 5px 10px;
            background: #fff;
            color: <?php echo esc_attr($bg_color); ?>;
            text-decoration: none;
            border-radius: 3px;
        }

        #cbp-bar button.cbp-close {
            background: transparent;
            border: none;
            color: <?php echo esc_attr($font_color); ?>;
            margin-left: 10px;
            cursor: pointer;
            font-weight: bold;
        }
    </style>

    <div id="cbp-bar">
        <span><?php echo esc_html($message); ?></span>
        <?php if (!empty($button_text)) : ?>
            <a href="<?php echo esc_url($button_url); ?>" class="cbp-button"><?php echo esc_html($button_text); ?></a>
        <?php endif; ?>
        <button onclick="this.parentElement.style.display='none'" class="cbp-close">×</button>
    </div>

    <?php if ($show_once === 'yes') : ?>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                if (localStorage.getItem('cbp_bar_seen')) {
                    document.getElementById('cbp-bar').style.display = 'none';
                } else {
                    localStorage.setItem('cbp_bar_seen', 'true');
                }
            });
        </script>
    <?php endif; ?>
<?php
}

// Add settings link to plugin in plugins list
function cbp_add_settings_link($links)
{
    $settings_link = '<a href="' . admin_url('admin.php?page=cbp-settings') . '">' . __('Settings') . '</a>';
    array_unshift($links, $settings_link);
    return $links;
}
$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'cbp_add_settings_link');

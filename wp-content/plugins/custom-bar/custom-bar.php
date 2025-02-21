<?php
/*
Plugin Name: Custom Bar
Description: Displays a customizable bar in the header or footer with global message.
Version: 1.0
Author: mrb

*/
// Admin Settings
add_action('admin_menu', 'custom_bar_add_admin_menu');
add_action('admin_init', 'custom_bar_settings_init');
// add_action('admin_enqueue_scripts', 'custom_bar_admin_scripts');

// Frontend Display
add_action('wp_footer', 'custom_bar_display');

function custom_bar_add_admin_menu()
{
    add_menu_page(
        'Custom Bar Settings', // Page title
        'Custom Bar',          // Menu title
        'manage_options',      // Capability
        'custom-bar-settings', // Menu slug
        'custom_bar_settings_page', // Function to display the settings page
        'dashicons-admin-generic',  // Icon URL (Dashicon class)
        80                      // Position in the menu
    );
}

function custom_bar_settings_page() // Display the settings page
{
?>
    <div class="wrap">
        <h1>Custom Bar Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('custom_bar_settings_group');
            do_settings_sections('custom-bar-settings');
            submit_button();
            ?>
        </form>
    </div>
<?php
}

function custom_bar_settings_init()
{
    register_setting(
        'custom_bar_settings_group',
        'custom_bar_options',
        ['sanitize_callback' => 'custom_bar_sanitize_options']
    );

    add_settings_section(
        'custom_bar_main_section',
        'Bar Settings',
        'custom_bar_main_section_cb',
        'custom-bar-settings'
    );

    add_settings_field(
        'enable',
        'Enable Custom Bar',
        'custom_bar_enable_cb',
        'custom-bar-settings',
        'custom_bar_main_section'
    );

    add_settings_field(
        'force_enable',
        'Force Enable Custom Bar',
        'custom_bar_force_enable_cb',
        'custom-bar-settings',
        'custom_bar_main_section'
    );


    add_settings_field(
        'location',
        'Bar Location',
        'custom_bar_location_cb',
        'custom-bar-settings',
        'custom_bar_main_section'
    );

    add_settings_field(
        'bg_color',
        'Background Color',
        'custom_bar_bg_color_cb',
        'custom-bar-settings',
        'custom_bar_main_section'
    );

    add_settings_field(
        'text_color',
        'Text Color',
        'custom_bar_text_color_cb',
        'custom-bar-settings',
        'custom_bar_main_section'
    );

    add_settings_field(
        'font_size',
        'Font Size (px)',
        'custom_bar_font_size_cb',
        'custom-bar-settings',
        'custom_bar_main_section'
    );

    add_settings_field(
        'message',
        'Bar Message',
        'custom_bar_message_cb',
        'custom-bar-settings',
        'custom_bar_main_section'
    );
}

function custom_bar_main_section_cb()
{
    echo '<p>Configure your custom bar settings.</p>';
}

function custom_bar_enable_cb()
{
    $options = get_option('custom_bar_options');
    echo '<input type="checkbox" name="custom_bar_options[enable]" value="1" ' . checked(1, $options['enable'] ?? 0, false) . ' />';
}

function custom_bar_force_enable_cb()
{
    $options = get_option('custom_bar_options');
    echo '<input type="checkbox" name="custom_bar_options[force_enable]" value="1" ' . checked(1, $options['force_enable'] ?? 0, false) . ' />';
}


function custom_bar_location_cb()
{
    $options = get_option('custom_bar_options');
?>
    <select name="custom_bar_options[location]">
        <option value="header" <?php selected($options['location'] ?? 'header', 'header'); ?>>Header</option>
        <option value="footer" <?php selected($options['location'] ?? 'header', 'footer'); ?>>Footer</option>
    </select>
    <?php
}

function custom_bar_bg_color_cb()
{
    $options = get_option('custom_bar_options');
    echo '<input type="color" name="custom_bar_options[bg_color]" value="' . esc_attr($options['bg_color'] ?? '#ffffff') . '" class="custom-bar-color-picker" />';
}

function custom_bar_text_color_cb()
{
    $options = get_option('custom_bar_options');
    echo '<input type="color" name="custom_bar_options[text_color]" value="' . esc_attr($options['text_color'] ?? '#000000') . '" class="custom-bar-color-picker" />';
}

function custom_bar_font_size_cb()
{
    $options = get_option('custom_bar_options');
    echo '<input type="number" name="custom_bar_options[font_size]" value="' . esc_attr($options['font_size'] ?? 14) . '" min="10" max="50" /> px';
}

function custom_bar_message_cb()
{
    $options = get_option('custom_bar_options');
    echo '<textarea name="custom_bar_options[message]" rows="5" cols="50">' . esc_textarea($options['message'] ?? '') . '</textarea>';
}

function custom_bar_sanitize_options($input)
{
    return [
        'enable' => isset($input['enable']) ? 1 : 0,
        'force_enable' => isset($input['force_enable']) ? 1 : 0,
        'location' => in_array($input['location'] ?? 'header', ['header', 'footer']) ? $input['location'] : 'header',
        'bg_color' => sanitize_hex_color($input['bg_color'] ?? '#ffffff'),
        'text_color' => sanitize_hex_color($input['text_color'] ?? '#000000'),
        'font_size' => absint($input['font_size'] ?? 14),
        'message' => sanitize_textarea_field($input['message'] ?? '')
    ];
}

// function custom_bar_admin_scripts($hook)
// {
//     if ('settings_page_custom-bar-settings' !== $hook) return;
//     wp_enqueue_style('wp-color-picker');
//     wp_enqueue_script('custom-bar-admin', plugins_url('admin.js', __FILE__), ['wp-color-picker'], false, true);
// }

function custom_bar_display()
{
    $options = get_option('custom_bar_options');

    // Force Enable overrides Enable setting
    $force_enable = !empty($options['force_enable']);
    $enabled = !empty($options['enable']) || $force_enable;

    if (!$enabled || empty($options['message'])) return;

    $styles = [
        'position: fixed',
        'left: 0',
        'right: 0',
        'padding: 15px',
        'text-align: center',
        'z-index: 9999',
        ($options['location'] ?? 'header') === 'header' ? 'top: 0' : 'bottom: 0',
        'background-color: ' . ($options['bg_color'] ?? '#ffffff'),
        'color: ' . ($options['text_color'] ?? '#000000'),
        'font-size: ' . ($options['font_size'] ?? 14) . 'px'
    ];

    echo '<div class="custom-bar" style="' . esc_attr(implode('; ', $styles)) . '">';
    echo '<span>' . esc_html($options['message']) . '</span>';

    // Show dismiss button only if Force Enable is OFF
    if (!$force_enable) {
        echo '<button class="custom-bar-dismiss" style="margin-left: 20px; float:right; color:red; font-size:large; font-weight:bold;">X</button>';
    }

    echo '</div>';
}

add_action('wp_footer', 'custom_bar_dismiss_script');

function custom_bar_dismiss_script()
{
    $options = get_option('custom_bar_options');
    $force_enable = !empty($options['force_enable']);

    if (!$force_enable) {
    ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const dismissButton = document.querySelector('.custom-bar-dismiss');
                if (dismissButton) {
                    dismissButton.addEventListener('click', function() {
                        document.querySelector('.custom-bar').style.display = 'none';
                    });
                }
            });
        </script>
<?php
        $options = get_option('custom_bar_options');
        $options['enable'] = 0;
        update_option('custom_bar_options', $options);
    }
}

<?php
/*
Plugin Name: Custom Bar
Description: Displays a customizable bar in the header or footer with global message.
Version: 1.0
Author: mrb

*/

// Start the session
if (!session_id()) {
    session_start();
}

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
add_action('admin_menu', 'custom_bar_add_admin_menu');

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

    add_settings_field(
        'message_for_each_post',
        'Message for Each Post',
        'custom_message_for_each_post_admin',
        'custom-bar-settings',
        'custom_bar_main_section'
    );
    add_settings_field(
        'message_for_each_post',
        'Message for Each Post',
        'custom_message_for_each_post_admin',
        'custom-bar-settings',
        'custom_bar_main_section'
    );
}

add_action('admin_init', 'custom_bar_settings_init');

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

function custom_bar_display()
{
    $options = get_option('custom_bar_options');

    // Force Enable overrides Enable setting
    $force_enable = !empty($options['force_enable']);
    $enabled = !empty($options['enable']) || $force_enable;

    if (!$enabled) {
        return;
    }

    if (isset($_SESSION['custom_bar_dismissed']) && $_SESSION['custom_bar_dismissed'] && !$force_enable) {
        return;
    }

    $message = $options['message'] ?? '';

    // Fetch custom message from post meta if available
    if (is_singular(['post', 'page'])) {
        global $post;
        $custom_message = get_post_meta($post->ID, '_custom_bar_message', true);
        if (!empty($custom_message)) {
            $message = $custom_message; // Override global message
        }
    }

    if (empty($message)) {
        return;
    }

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
    echo '<span>' . esc_html($message) . '</span>';

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
                        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: 'action=dismiss_custom_bar'
                        });
                    });
                }
            });
        </script>
<?php
    }
}

add_action('wp_ajax_dismiss_custom_bar', 'custom_bar_dismiss');
add_action('wp_ajax_nopriv_dismiss_custom_bar', 'custom_bar_dismiss');

function custom_bar_dismiss()
{
    $_SESSION['custom_bar_dismissed'] = true;
    wp_die();
}


##custom bar massage for each post.
// Add meta box to post editor
function custom_bar_add_meta_box()
{
    add_meta_box(
        'custom_bar_meta_box',
        'Custom Bar Message',
        'custom_bar_meta_box_callback',
        ['post', 'page'], // Show in posts and pages
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'custom_bar_add_meta_box');

function custom_bar_meta_box_callback($post)
{
    $message = get_post_meta($post->ID, '_custom_bar_message', true);
    wp_nonce_field('custom_bar_save_meta_box_data', 'custom_bar_meta_box_nonce');
    echo '<textarea name="custom_bar_message" rows="5" cols="50">' . esc_textarea($message) . '</textarea>';
}

// Add meta box to post editor
function custom_bar_save_meta_box_data($post_id)
{
    if (!isset($_POST['custom_bar_meta_box_nonce']) || !wp_verify_nonce($_POST['custom_bar_meta_box_nonce'], 'custom_bar_save_meta_box_data')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['custom_bar_message'])) {
        update_post_meta($post_id, '_custom_bar_message', sanitize_text_field($_POST['custom_bar_message']));
    } else {
        delete_post_meta($post_id, '_custom_bar_message');
    }
}
add_action('save_post', 'custom_bar_save_meta_box_data');

// Display a message in the settings page in custom-bar settings
function custom_message_for_each_post_admin()
{
    echo '<p>Each post/page can have a unique custom bar message set in the post editor.</p>';
}

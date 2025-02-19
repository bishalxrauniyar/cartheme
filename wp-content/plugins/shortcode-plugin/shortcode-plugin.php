<?php

/**
 * Plugin Name: Shortcode Plugin
 * Description: A WordPress plugin to display a custom shortcode.
 * Version: 1.0
 * Author: BR
 * Author URI: https://www.instagram.com/bishalxrauniyar/
 * Plugin URI: https://www.instagram.com/bishalxrauniyar/
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: sp
 * Domain Path: /languages
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

add_shortcode(
    'message',
    'sp_display_message'

);
function sp_display_message()
{
    return 'Hello, World! This is a custom shortcode message.';
}

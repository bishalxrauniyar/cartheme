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
//Shortcodes are a way to add dynamic content to your WordPress posts, pages, and widgets. They are a type of WordPress hook that allows you to add custom content to your site using a simple shortcode tag.
//Shortcodes are enclosed in square brackets, like this: [shortcode]. When WordPress encounters a shortcode in the content of a post or page, it replaces the shortcode with the output of a PHP function defined by the shortcode.
add_shortcode(
    'message',
    'sp_display_message'

);
function sp_display_message() //This function will return a simple message when the [message] shortcode is used in a post or page.
{
    return '<p style="color: red;">Hello, World! This is a custom shortcode message.</p>'; //use the return statement to return the message. echo will not work here as it will output the message directly to the page instead of returning it.
}


// parameterized shortcode
add_shortcode(
    'greeting',
    'sp_display_greeting'
);
function sp_display_greeting($atts) //This function will display a custom greeting message based on the attributes passed to the [greeting] shortcode.
{
    $atts = shortcode_atts(
        array(
            'name' => 'Guest',
        ),
        $atts,
        'greeting'
    );
    return '<p style="color: aqua;">Hello, ' . esc_html($atts['name']) . '! Welcome to our site.</p>';
}

// copyright shortcode
add_shortcode(
    'copyright',
    'sp_display_copyright'
);
function sp_display_copyright()
{
    return '<p style="color: green;">&copy;' . date('Y') . ' All rights reserved. Designed and developed by <a href="https://www.themesine.com/">themesine</a>.</p>';
}

//shortcode for db operation
add_shortcode(
    'db_operation',
    'sp_db_operation'
);
function sp_db_operation()
{
    global $wpdb;
};

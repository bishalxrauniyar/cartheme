<?php

/**
 * Plugin Name: Hello World Plugin
 * Description: A WordPress plugin to display a simple message.
 * Version: 1.0
 * Author: BR
 * Author URI: https://www.instagram.com/bishalxrauniyar/
 * Plugin URI: https://www.instagram.com/bishalxrauniyar/
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: hwp
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}
//Admin Notices is a way to display messages to the user in the WordPress admin area.Admin notices are commonly used to inform users about successful or failed actions, to warn users about potential issues, or to prompt users to take specific actions.


function hwp_admin_notice()
{
?>
    <div class="notice notice-success is-dismissible">
        <p><?php _e('Hello World Plugin activated!'); ?></p>
    </div>
<?php
}
add_action('admin_notices', 'hwp_admin_notice');


//Admin Dashboard Widget is a way to display information to the user in the WordPress admin dashboard. Dashboard widgets are commonly used to display statistics, quick links, or other information that is relevant to the user.


function hwp_dashboard_widget()
{
    wp_add_dashboard_widget('hwp_dashboard_widget', 'Hello World Plugin CarTheme', 'hwp_dashboard_widget_content');
}
add_action('wp_dashboard_setup', 'hwp_dashboard_widget');
//The wp_dashboard_setup action hook is used to add dashboard widgets to the WordPress admin dashboard. The hook is triggered when the dashboard is initialized, allowing plugins and themes to add their own custom widgets to the dashboard.

//wp_add_dashboard_widget() function is used to add a new dashboard widget to the WordPress admin dashboard. The function takes three parameters: the widget ID, the widget title, and the widget content callback function.

function hwp_dashboard_widget_content()
{
    echo '<h1>CarTheme</h1>
    <br>
    <p>Hello, World of Carz! This is a simple message from the Hello World Plugin.</p>';
}

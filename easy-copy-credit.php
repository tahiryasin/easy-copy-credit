<?php
/*
 * Plugin Name:       Easy Copy Credit
 * Plugin URI:        https://scriptbaker.com/easy-copy-credit
 * Description:       Automatically appends a customizable citation to copied text on your WordPress site.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Tahir Yasin
 * Author URI:        https://scriptbaker.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       easy-copy-credit
 * Tags:			  easy, copy, credit, credits, citation, easy-copy-credit, copy-right
 */

// Define plugin path
define('EASY_COPY_CREDIT_PATH', plugin_dir_path(__FILE__));

// Include necessary files
include_once EASY_COPY_CREDIT_PATH . 'includes/settings.php';
include_once EASY_COPY_CREDIT_PATH . 'includes/frontend.php';

// Register activation and deactivation hooks
register_activation_hook(__FILE__, 'easy_copy_credit_activate');
register_deactivation_hook(__FILE__, 'easy_copy_credit_deactivate');

// Activation function
function easy_copy_credit_activate() {
    // Set default options if they don’t exist
    if (!get_option('easy_copy_credit_default_template')) {
        update_option('easy_copy_credit_default_template', "\n\nSource: [page_title]\n[page_url]");
    }
}

// Deactivation function
function easy_copy_credit_deactivate() {
    // Optional: Actions to perform on deactivation
}

// Uninstall hook
register_uninstall_hook(__FILE__, 'easy_copy_credit_uninstall');

// Enqueue admin and frontend scripts as needed
add_action('admin_enqueue_scripts', 'easy_copy_credit_admin_scripts');
add_action('wp_enqueue_scripts', 'easy_copy_credit_frontend_scripts');


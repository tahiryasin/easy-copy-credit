<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Enqueue frontend script
function easy_copy_credit_frontend_scripts() {
    wp_enqueue_script('easy-copy-credit-script', plugins_url('/assets/js/copy-credit.js', dirname(__FILE__)), array('jquery'), '1.0', true);
    wp_localize_script('easy-copy-credit-script', 'easyCopyCredit', array(
        'defaultTemplate' => get_option('easy_copy_credit_default_template', "\n\nSource: The Center for Nutritional Psychology\n[page_url]"),
        'templates' => get_templates_for_post_types(),
        'pageUrl' => get_permalink(),
        'pageTitle' => get_the_title(),
    ));
}

// Get templates for all registered custom post types
function get_templates_for_post_types() {
    $post_types = get_post_types(['public' => true], 'objects');
    $templates = [];
    foreach ($post_types as $post_type) {
        $templates[$post_type->name] = get_option('easy_copy_credit_template_' . $post_type->name, "\n\nSource: [page_title]\n[page_url]");
    }
    return $templates;
}

add_action('wp_footer', 'easy_copy_credit_frontend_scripts');
?>

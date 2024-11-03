<?php
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) exit;

// Delete options created by the plugin
delete_option('easy_copy_credit_default_template');

$post_types = get_post_types(['public' => true], 'objects');
foreach ($post_types as $post_type) {
    delete_option('easy_copy_credit_template_' . $post_type->name);
}
?>

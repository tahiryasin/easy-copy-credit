<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Register settings and add settings page
function easy_copy_credit_register_settings() {
    register_setting('easy_copy_credit_options', 'easy_copy_credit_default_template');

    $post_types = get_post_types(['public' => true], 'objects');
    foreach ($post_types as $post_type) {
        register_setting('easy_copy_credit_options', 'easy_copy_credit_template_' . $post_type->name);
    }

    add_settings_section('easy_copy_credit_main', 'Easy Copy Credit Settings', 'easy_copy_credit_section_text', 'easy_copy_credit');

    add_settings_field('easy_copy_credit_default_template', 'Default Citation Template', 'easy_copy_credit_default_template_field', 'easy_copy_credit', 'easy_copy_credit_main');

    foreach ($post_types as $post_type) {
        add_settings_field(
            'easy_copy_credit_template_' . $post_type->name,
            ucfirst($post_type->labels->singular_name) . ' Citation Template',
            function() use ($post_type) {
                $option_name = 'easy_copy_credit_template_' . $post_type->name;
                $value = get_option($option_name, "\n\nSource: [page_title]\n[page_url]");
                echo "<textarea name='{$option_name}' rows='5' cols='100'>" . esc_textarea($value) . "</textarea>";
                echo "<p>Use [page_title] and [page_url] placeholders.</p>";
            },
            'easy_copy_credit',
            'easy_copy_credit_main'
        );
    }
}

function easy_copy_credit_section_text() {
    echo '<p>Customize the citation templates for copied content.</p>';
}

function easy_copy_credit_default_template_field() {
    $value = get_option('easy_copy_credit_default_template', "\n\nSource: The Center for Nutritional Psychology\n[page_url]");
    echo "<textarea name='easy_copy_credit_default_template' rows='5' cols='100'>" . esc_textarea($value) . "</textarea>";
    echo "<p>Use [page_title] and [page_url] placeholders in your template.</p>";
}


function easy_copy_credit_settings_page() {
    ?>
    <div class="wrap">
        <h2>Easy Copy Credit Settings</h2>
        <form action="options.php" method="post">
            <?php
            settings_fields('easy_copy_credit_options');
            do_settings_sections('easy_copy_credit');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function easy_copy_credit_add_menu() {
    add_options_page('Easy Copy Credit Settings', 'Easy Copy Credit', 'manage_options', 'easy-copy-credit', 'easy_copy_credit_settings_page');
}

add_action('admin_init', 'easy_copy_credit_register_settings');
add_action('admin_menu', 'easy_copy_credit_add_menu');
?>

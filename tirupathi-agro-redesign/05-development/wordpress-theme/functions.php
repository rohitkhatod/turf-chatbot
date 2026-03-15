<?php
/**
 * Theme setup and assets.
 */

if (! defined('ABSPATH')) {
    exit;
}

function tirupathi_agro_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);

    register_nav_menus([
        'primary' => __('Primary Menu', 'tirupathi-agro-modern'),
        'footer'  => __('Footer Menu', 'tirupathi-agro-modern'),
    ]);
}
add_action('after_setup_theme', 'tirupathi_agro_theme_setup');

function tirupathi_agro_enqueue_assets() {
    wp_enqueue_style(
        'tirupathi-agro-main',
        get_template_directory_uri() . '/assets/css/main.css',
        [],
        '1.1.0'
    );

    wp_enqueue_script(
        'tirupathi-agro-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        '1.1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'tirupathi_agro_enqueue_assets');

function tirupathi_agro_add_schema() {
    if (! is_front_page()) {
        return;
    }

    $schema = [
        '@context'    => 'https://schema.org',
        '@type'       => 'Organization',
        'name'        => 'Tirupathi Agro',
        'url'         => home_url('/'),
        'description' => 'Supplier of agriculture products and crop solutions for farmers, distributors, and institutions.',
        'email'       => 'info@tirupathiagro.com',
        'telephone'   => '+91-00000-00000',
    ];

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';
}
add_action('wp_head', 'tirupathi_agro_add_schema', 20);

/**
 * Handle homepage lead form submissions.
 */
function tirupathi_agro_handle_lead_form() {
    if (! isset($_POST['tirupathi_agro_nonce']) || ! wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['tirupathi_agro_nonce'])), 'tirupathi_agro_lead_form')) {
        wp_safe_redirect(add_query_arg('lead_status', 'invalid_nonce', home_url('/')));
        exit;
    }

    $name    = isset($_POST['name']) ? sanitize_text_field(wp_unslash($_POST['name'])) : '';
    $phone   = isset($_POST['phone']) ? sanitize_text_field(wp_unslash($_POST['phone'])) : '';
    $message = isset($_POST['message']) ? sanitize_textarea_field(wp_unslash($_POST['message'])) : '';

    if ($name === '' || $phone === '' || $message === '') {
        wp_safe_redirect(add_query_arg('lead_status', 'missing_fields', home_url('/#contact')));
        exit;
    }

    $to = get_option('admin_email');
    $subject = sprintf('New website enquiry from %s', $name);
    $body = "Name: {$name}\nPhone: {$phone}\n\nRequirement:\n{$message}";
    $headers = ['Content-Type: text/plain; charset=UTF-8'];

    $sent = wp_mail($to, $subject, $body, $headers);
    $status = $sent ? 'success' : 'mail_failed';

    wp_safe_redirect(add_query_arg('lead_status', $status, home_url('/#contact')));
    exit;
}
add_action('admin_post_nopriv_tirupathi_agro_lead', 'tirupathi_agro_handle_lead_form');
add_action('admin_post_tirupathi_agro_lead', 'tirupathi_agro_handle_lead_form');

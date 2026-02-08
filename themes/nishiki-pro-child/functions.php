<?php

if (!defined('ABSPATH')) {
    exit;
}

add_action('wp_enqueue_scripts', function () {
    $parent = wp_get_theme(get_template());
    wp_enqueue_style(
        'nishiki-pro-parent',
        get_template_directory_uri() . '/style.css',
        [],
        $parent->get('Version')
    );

    wp_enqueue_style(
        'nishiki-pro-child-fonts',
        'https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Noto+Sans+JP:wght@400;500;700&display=swap',
        [],
        null
    );

    $child = wp_get_theme();
    wp_enqueue_style(
        'nishiki-pro-child',
        get_stylesheet_directory_uri() . '/assets/css/main.css',
        ['nishiki-pro-parent'],
        $child->get('Version')
    );

    // Single post improvements CSS
    if (is_single()) {
        wp_enqueue_style(
            'nishiki-pro-child-single',
            get_stylesheet_directory_uri() . '/assets/css/single-improvements.css',
            ['nishiki-pro-child'],
            $child->get('Version')
        );
    }

    // Archive page improvements CSS & JS
    if (is_home() || is_archive() || is_search()) {
        wp_enqueue_style(
            'nishiki-pro-child-archive',
            get_stylesheet_directory_uri() . '/assets/css/archive-improvements.css',
            ['nishiki-pro-child'],
            $child->get('Version')
        );

        wp_enqueue_script(
            'nishiki-pro-child-archive',
            get_stylesheet_directory_uri() . '/assets/js/archive.js',
            [],
            $child->get('Version'),
            true
        );
    }

    // Header Enhancement JS
    wp_enqueue_script(
        'nishiki-pro-child-header',
        get_stylesheet_directory_uri() . '/assets/js/header.js',
        [],
        $child->get('Version'),
        true
    );

    // Hero section JavaScript
    wp_enqueue_script(
        'nishiki-pro-child-hero',
        get_stylesheet_directory_uri() . '/assets/js/hero.js',
        [],
        $child->get('Version'),
        true
    );

    // Categories section JavaScript
    wp_enqueue_script(
        'nishiki-pro-child-categories',
        get_stylesheet_directory_uri() . '/assets/js/categories.js',
        [],
        $child->get('Version'),
        true
    );

    // Features section JavaScript
    wp_enqueue_script(
        'nishiki-pro-child-features',
        get_stylesheet_directory_uri() . '/assets/js/features.js',
        [],
        $child->get('Version'),
        true
    );

    // Latest Posts Slider JS
    wp_enqueue_script(
        'nishiki-pro-child-latest-posts',
        get_stylesheet_directory_uri() . '/assets/js/latest-posts.js',
        [],
        $child->get('Version'),
        true
    );

    // Archive CTA JS
    wp_enqueue_script(
        'nishiki-pro-child-archive-cta',
        get_stylesheet_directory_uri() . '/assets/js/archive-cta.js',
        [],
        $child->get('Version'),
        true
    );

    // Footer CTA JS (About導線)
    wp_enqueue_script(
        'nishiki-pro-child-footer-cta',
        get_stylesheet_directory_uri() . '/assets/js/footer-cta.js',
        [],
        $child->get('Version'),
        true
    );

    // Single Article JS (記事ページ用)
    if (is_single()) {
        wp_enqueue_script(
            'nishiki-pro-child-single',
            get_stylesheet_directory_uri() . '/assets/js/single.js',
            [],
            $child->get('Version'),
            true
        );
    }
});

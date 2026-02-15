<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * /blog 専用ルーティング（固定ページ設定に依存しないフォールバック）
 */
add_action('init', function() {
    add_rewrite_tag('%nishiki_blog%', '1');
    add_rewrite_rule('^blog/?$', 'index.php?nishiki_blog=1', 'top');
    add_rewrite_rule('^blog/page/([0-9]{1,})/?$', 'index.php?nishiki_blog=1&paged=$matches[1]', 'top');
}, 5);

add_filter('query_vars', function($vars) {
    $vars[] = 'nishiki_blog';
    return $vars;
});

add_filter('template_include', function($template) {
    $request_path = trim((string) parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
    $is_blog_path = preg_match('#^blog(?:/page/([0-9]+))?$#', $request_path, $matches);

    if ($is_blog_path && !empty($matches[1])) {
        set_query_var('paged', (int) $matches[1]);
    }

    if (get_query_var('nishiki_blog') || $is_blog_path) {
        $blog_template = get_stylesheet_directory() . '/page-blog.php';
        if (file_exists($blog_template)) {
            return $blog_template;
        }
    }
    return $template;
}, 99);

add_filter('body_class', function($classes) {
    if (get_query_var('nishiki_blog')) {
        $classes[] = 'page-template-page-blog';
        $classes[] = 'page-template';
    }
    return array_unique($classes);
});

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

    // About page CSS & JS
    if (is_page_template('page-about.php')) {
        wp_enqueue_style(
            'nishiki-pro-child-about',
            get_stylesheet_directory_uri() . '/assets/css/page-about.css',
            ['nishiki-pro-child'],
            $child->get('Version')
        );

        wp_enqueue_script(
            'nishiki-pro-child-about',
            get_stylesheet_directory_uri() . '/assets/js/about.js',
            [],
            $child->get('Version'),
            true
        );
    }

    // Archive page improvements CSS & JS
    if (is_home() || is_archive() || is_search() || is_page('blog') || is_page_template('page-blog.php') || get_query_var('nishiki_blog')) {
        $archive_css = get_stylesheet_directory() . '/assets/css/archive-improvements.css';
        $archive_js = get_stylesheet_directory() . '/assets/js/archive.js';
        wp_enqueue_style(
            'nishiki-pro-child-archive',
            get_stylesheet_directory_uri() . '/assets/css/archive-improvements.css',
            ['nishiki-pro-child'],
            file_exists($archive_css) ? filemtime($archive_css) : $child->get('Version')
        );

        wp_enqueue_script(
            'nishiki-pro-child-archive',
            get_stylesheet_directory_uri() . '/assets/js/archive.js',
            [],
            file_exists($archive_js) ? filemtime($archive_js) : $child->get('Version'),
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

/**
 * About固定ページを自動生成
 */
function create_about_page_automatically() {
    // 既にAboutページが存在するかチェック
    $about_page = get_page_by_path('about');
    
    if (!$about_page) {
        // Aboutページを作成
        $page_data = array(
            'post_title'    => 'About',
            'post_content'  => '',
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_name'     => 'about'
        );
        
        $page_id = wp_insert_post($page_data);
        
        // テンプレートを設定
        if ($page_id) {
            update_post_meta($page_id, '_wp_page_template', 'page-about.php');
            
            // パーマリンクを更新
            flush_rewrite_rules();
        }
    }
}

/**
 * Blog固定ページを自動生成
 */
function create_blog_page_automatically() {
    $needs_flush = false;

    // 既にBlogページが存在するかチェック
    $blog_page = get_page_by_path('blog');

    if (!$blog_page) {
        // Blogページを作成
        $page_data = array(
            'post_title'    => 'Blog',
            'post_content'  => '',
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_name'     => 'blog'
        );

        $page_id = wp_insert_post($page_data);

        // テンプレートを設定
        if ($page_id) {
            update_post_meta($page_id, '_wp_page_template', 'page-blog.php');
            $needs_flush = true;
        }
    } else {
        // 既存blogページにもテンプレートを適用
        $current_template = get_post_meta($blog_page->ID, '_wp_page_template', true);
        if ($current_template !== 'page-blog.php') {
            update_post_meta($blog_page->ID, '_wp_page_template', 'page-blog.php');
        }
    }

    // 一度だけリライトルールを更新（既存ページでも404回避）
    $rewrite_key = 'nishiki_child_blog_rewrite_flushed_v1';
    if ($needs_flush || !get_option($rewrite_key)) {
        flush_rewrite_rules(false);
        update_option($rewrite_key, '1', false);
    }
}

// テーマ有効化時に実行
add_action('after_switch_theme', function() {
    create_about_page_automatically();
    create_blog_page_automatically();
});

// 初回読み込み時にも実行
add_action('init', function() {
    static $run_once = false;
    if (!$run_once) {
        create_about_page_automatically();
        create_blog_page_automatically();

        // ルーティング更新（/blog フォールバック用）
        $route_key = 'nishiki_child_blog_route_flushed_v2';
        if (!get_option($route_key)) {
            flush_rewrite_rules(false);
            update_option($route_key, '1', false);
        }

        $run_once = true;
    }
}, 999);

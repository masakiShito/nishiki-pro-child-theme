<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * $_SERVER['REQUEST_URI'] をサニタイズして取得
 */
function nishiki_get_sanitized_request_path() {
    $request_uri = isset($_SERVER['REQUEST_URI']) ? sanitize_text_field(wp_unslash($_SERVER['REQUEST_URI'])) : '';
    return trim((string) parse_url($request_uri, PHP_URL_PATH), '/');
}

function nishiki_is_blog_request_path() {
    $request_path = nishiki_get_sanitized_request_path();
    return (bool) preg_match('#^blog(?:/page/([0-9]+))?$#', $request_path);
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
    $request_path = nishiki_get_sanitized_request_path();
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
    if (get_query_var('nishiki_blog') || nishiki_is_blog_request_path()) {
        $classes[] = 'page-template-page-blog';
        $classes[] = 'page-template';
        $classes[] = 'blog-list-route';
    }

    // カテゴリ別テンプレートのbodyクラス追加
    if (is_single()) {
        $cat_slug = nishiki_get_current_post_category_style();
        if ($cat_slug) {
            $classes[] = 'single-category-' . $cat_slug;
        }
    }

    if (is_category()) {
        $category = get_queried_object();
        if ($category instanceof WP_Term) {
            $cat_slug = nishiki_get_term_category_style($category);
            if ($cat_slug) {
                $classes[] = 'archive-category-' . $cat_slug;
            }
        }
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
        'https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Noto+Sans+JP:wght@400;500;600;700&display=swap',
        [],
        false
    );

    $child = wp_get_theme();
    wp_enqueue_style(
        'nishiki-pro-child',
        get_stylesheet_directory_uri() . '/assets/css/main.css',
        ['nishiki-pro-parent'],
        $child->get('Version')
    );

    // Single post improvements CSS + JetBrains Mono font (コードエディタ風目次用)
    if (is_single()) {
        wp_enqueue_style(
            'nishiki-pro-child-jetbrains-mono',
            'https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&display=swap',
            [],
            false
        );
        wp_enqueue_style(
            'nishiki-pro-child-single',
            get_stylesheet_directory_uri() . '/assets/css/single-improvements.css',
            ['nishiki-pro-child'],
            $child->get('Version')
        );

        // カテゴリ別CSS読み込み
        $cat_slug = nishiki_get_current_post_category_style();
        if ($cat_slug) {
            $css_map = nishiki_get_category_css_map();
            if (isset($css_map[$cat_slug])) {
                $css_file = get_stylesheet_directory() . '/assets/css/' . $css_map[$cat_slug];
                if (file_exists($css_file)) {
                    wp_enqueue_style(
                        'nishiki-pro-child-single-' . $cat_slug,
                        get_stylesheet_directory_uri() . '/assets/css/' . $css_map[$cat_slug],
                        ['nishiki-pro-child-single'],
                        filemtime($css_file)
                    );
                }
            }
        }

        // Single Article JS (記事ページ用)
        wp_enqueue_script(
            'nishiki-pro-child-single',
            get_stylesheet_directory_uri() . '/assets/js/single.js',
            [],
            $child->get('Version'),
            true
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
    $is_archive_page = is_home() || is_archive() || is_search() || is_page('blog') || is_page_template('page-blog.php') || get_query_var('nishiki_blog') || nishiki_is_blog_request_path();
    if ($is_archive_page) {
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

    // Header Enhancement JS (全ページ共通)
    wp_enqueue_script(
        'nishiki-pro-child-header',
        get_stylesheet_directory_uri() . '/assets/js/header.js',
        [],
        $child->get('Version'),
        true
    );

    // フロントページ専用JS
    if (is_front_page()) {
        wp_enqueue_script(
            'nishiki-pro-child-hero',
            get_stylesheet_directory_uri() . '/assets/js/hero.js',
            [],
            $child->get('Version'),
            true
        );

        wp_enqueue_script(
            'nishiki-pro-child-categories',
            get_stylesheet_directory_uri() . '/assets/js/categories.js',
            [],
            $child->get('Version'),
            true
        );

        wp_enqueue_script(
            'nishiki-pro-child-features',
            get_stylesheet_directory_uri() . '/assets/js/features.js',
            [],
            $child->get('Version'),
            true
        );

        wp_enqueue_script(
            'nishiki-pro-child-latest-posts',
            get_stylesheet_directory_uri() . '/assets/js/latest-posts.js',
            [],
            $child->get('Version'),
            true
        );

        wp_enqueue_script(
            'nishiki-pro-child-archive-cta',
            get_stylesheet_directory_uri() . '/assets/js/archive-cta.js',
            [],
            $child->get('Version'),
            true
        );

        wp_enqueue_script(
            'nishiki-pro-child-footer-cta',
            get_stylesheet_directory_uri() . '/assets/js/footer-cta.js',
            [],
            $child->get('Version'),
            true
        );
    }
});

/**
 * About固定ページを自動生成（テーマ有効化時のみ）
 */
function create_about_page_automatically() {
    $about_page = get_page_by_path('about');

    if (!$about_page) {
        $page_data = array(
            'post_title'    => 'About',
            'post_content'  => '',
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_name'     => 'about'
        );

        $page_id = wp_insert_post($page_data);

        if ($page_id && !is_wp_error($page_id)) {
            update_post_meta($page_id, '_wp_page_template', 'page-about.php');
        }
    }
}

/**
 * Blog固定ページを自動生成（テーマ有効化時のみ）
 */
function create_blog_page_automatically() {
    $blog_page = get_page_by_path('blog');

    if (!$blog_page) {
        $page_data = array(
            'post_title'    => 'Blog',
            'post_content'  => '',
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_name'     => 'blog'
        );

        $page_id = wp_insert_post($page_data);

        if ($page_id && !is_wp_error($page_id)) {
            update_post_meta($page_id, '_wp_page_template', 'page-blog.php');
        }
    } else {
        // 既存blogページにもテンプレートを適用
        $current_template = get_post_meta($blog_page->ID, '_wp_page_template', true);
        if ($current_template !== 'page-blog.php') {
            update_post_meta($blog_page->ID, '_wp_page_template', 'page-blog.php');
        }
    }
}

/**
 * カテゴリ別テンプレート設定
 * カテゴリスラッグとテンプレートファイルのマッピング
 */
function nishiki_get_category_template_map() {
    return array(
        'development'    => 'single-category-development.php',
        'infrastructure' => 'single-category-infrastructure.php',
        'knowledge'      => 'single-category-knowledge.php',
    );
}

/**
 * カテゴリに基づいて記事テンプレートを切り替え
 */
add_filter('single_template', function($template) {
    if (!is_single()) {
        return $template;
    }

    $categories = get_the_category();
    if (empty($categories)) {
        return $template;
    }

    $map = nishiki_get_category_template_map();

    foreach ($categories as $cat) {
        $check_cats = array($cat);
        if ($cat->parent) {
            $parent = get_category($cat->parent);
            if ($parent && !is_wp_error($parent)) {
                $check_cats[] = $parent;
            }
        }

        foreach ($check_cats as $check_cat) {
            if (isset($map[$check_cat->slug])) {
                $category_template = get_stylesheet_directory() . '/' . $map[$check_cat->slug];
                if (file_exists($category_template)) {
                    return $category_template;
                }
            }
        }
    }

    return $template;
});

/**
 * カテゴリ別テンプレートのCSSとフォントマッピング
 */
function nishiki_get_category_css_map() {
    return array(
        'development'    => 'single-development.css',
        'infrastructure' => 'single-infrastructure.css',
        'knowledge'      => 'single-knowledge.css',
    );
}

/**
 * カテゴリーデザイン定義
 */
function nishiki_get_category_theme_map() {
    return array(
        'development' => array(
            'label' => 'Build',
            'lead' => '実装・設計・改善の流れを、コードと判断の文脈ごと整理します。',
            'description' => '設計判断、実装パターン、改善の進め方を開発者目線でまとめたカテゴリです。',
            'icon' => '</>',
            'palette' => 'linear-gradient(135deg, #10281f 0%, #1f5a43 52%, #4f8a72 100%)',
            'surface' => 'linear-gradient(180deg, #edf5f1 0%, #d7e7df 100%)',
            'accent' => '#1f5a43',
            'accent_dark' => '#153c2d',
            'accent_light' => '#4f8a72',
            'glow' => 'rgba(31, 90, 67, 0.22)',
        ),
        'infrastructure' => array(
            'label' => 'Operate',
            'lead' => '構成、運用、監視まで含めて、安定稼働する仕組みを扱います。',
            'description' => 'サーバー、クラウド、監視、運用設計までを構造的に扱うカテゴリです。',
            'icon' => '[]',
            'palette' => 'linear-gradient(135deg, #0f261e 0%, #1a4d3a 46%, #40755f 100%)',
            'surface' => 'linear-gradient(180deg, #eaf3ef 0%, #d2e4dc 100%)',
            'accent' => '#245d47',
            'accent_dark' => '#153c2d',
            'accent_light' => '#4f8a72',
            'glow' => 'rgba(36, 93, 71, 0.24)',
        ),
        'knowledge' => array(
            'label' => 'Insight',
            'lead' => '知識を断片で終わらせず、背景と使いどころまで含めて残します。',
            'description' => '学び、調査、考え方を読み物として蓄積するナレッジカテゴリです。',
            'icon' => '::',
            'palette' => 'linear-gradient(135deg, #173228 0%, #2e6651 52%, #5e947d 100%)',
            'surface' => 'linear-gradient(180deg, #eef6f2 0%, #dceae3 100%)',
            'accent' => '#2e6651',
            'accent_dark' => '#1b4334',
            'accent_light' => '#5e947d',
            'glow' => 'rgba(46, 102, 81, 0.24)',
        ),
    );
}

/**
 * タームからカテゴリーデザイン用スラッグを解決
 */
function nishiki_get_term_category_style($term) {
    if (!$term instanceof WP_Term) {
        return null;
    }

    $map = nishiki_get_category_css_map();
    $check_slugs = array($term->slug);

    if ('category' === $term->taxonomy && $term->parent) {
        $parent = get_category($term->parent);
        if ($parent && !is_wp_error($parent)) {
            $check_slugs[] = $parent->slug;
        }
    }

    foreach ($check_slugs as $slug) {
        if (isset($map[$slug])) {
            return $slug;
        }
    }

    return null;
}

/**
 * デザイン定義を取得。未定義カテゴリは緩やかなデフォルトにフォールバック
 */
function nishiki_get_category_theme($slug = null) {
    $themes = nishiki_get_category_theme_map();

    if ($slug && isset($themes[$slug])) {
        return $themes[$slug];
    }

    return array(
        'label' => 'Browse',
        'lead' => 'テーマごとに記事を整理しています。',
        'description' => 'このカテゴリの記事をまとめてチェックできます。',
        'icon' => '//',
        'palette' => 'linear-gradient(135deg, #10281f 0%, #1f5a43 52%, #4f8a72 100%)',
        'surface' => 'linear-gradient(180deg, #edf5f1 0%, #d7e7df 100%)',
        'accent' => '#1f5a43',
        'accent_dark' => '#153c2d',
        'accent_light' => '#4f8a72',
        'glow' => 'rgba(31, 90, 67, 0.2)',
    );
}

/**
 * 現在の投稿のカテゴリスラッグを取得（テンプレートマップに一致するもの）
 */
function nishiki_get_current_post_category_style() {
    if (!is_single()) {
        return null;
    }

    $categories = get_the_category();
    if (empty($categories)) {
        return null;
    }

    foreach ($categories as $cat) {
        $slug = nishiki_get_term_category_style($cat);
        if ($slug) {
            return $slug;
        }
    }

    return null;
}

// 記事ページ末尾の黒帯フィードセクションを削除
add_action('template_redirect', function() {
    if (is_single()) {
        remove_all_actions('nishiki_pro_after_inner_content');
        remove_all_actions('nishiki_pro_after_content');
    }
}, 5);

// テーマ有効化時にページ自動生成＋リライトルール更新
add_action('after_switch_theme', function() {
    create_about_page_automatically();
    create_blog_page_automatically();
    flush_rewrite_rules(false);
});

/**
 * ローカルアバター: プロフィール画面でメディアライブラリを有効化
 */
add_action( 'admin_enqueue_scripts', function( $hook ) {
    if ( in_array( $hook, [ 'profile.php', 'user-edit.php' ], true ) ) {
        wp_enqueue_media();
    }
} );

/**
 * ローカルアバター: ユーザープロフィール画面に画像選択フィールドを追加
 */
function nishiki_avatar_profile_fields( $user ) {
    $avatar_id = get_user_meta( $user->ID, 'nishiki_local_avatar_id', true );
    $avatar_url = $avatar_id ? wp_get_attachment_image_url( (int) $avatar_id, 'thumbnail' ) : '';
    ?>
    <h3>プロフィール画像（ローカル）</h3>
    <table class="form-table">
        <tr>
            <th><label for="nishiki_local_avatar">プロフィール画像</label></th>
            <td>
                <?php if ( $avatar_url ) : ?>
                    <img id="nishiki_local_avatar_preview" src="<?php echo esc_url( $avatar_url ); ?>" style="width:80px;height:80px;border-radius:50%;object-fit:cover;display:block;margin-bottom:8px;">
                <?php else : ?>
                    <img id="nishiki_local_avatar_preview" src="" style="width:80px;height:80px;border-radius:50%;object-fit:cover;display:none;margin-bottom:8px;">
                <?php endif; ?>
                <input type="hidden" name="nishiki_local_avatar_id" id="nishiki_local_avatar_id" value="<?php echo esc_attr( $avatar_id ); ?>">
                <?php wp_nonce_field( 'nishiki_avatar_save', 'nishiki_avatar_nonce' ); ?>
                <button type="button" class="button" id="nishiki_upload_avatar_btn">画像を選択</button>
                <?php if ( $avatar_id ) : ?>
                    <button type="button" class="button" id="nishiki_remove_avatar_btn">削除</button>
                <?php endif; ?>
                <p class="description">メディアライブラリから画像を選択してください。設定するとGravatarの代わりに使用されます。</p>
            </td>
        </tr>
    </table>
    <script>
    jQuery(function($) {
        var frame;
        $('#nishiki_upload_avatar_btn').on('click', function(e) {
            e.preventDefault();
            if (frame) { frame.open(); return; }
            frame = wp.media({ title: 'プロフィール画像を選択', button: { text: '選択' }, multiple: false });
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                $('#nishiki_local_avatar_id').val(attachment.id);
                var previewUrl = attachment.sizes && attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;
                $('#nishiki_local_avatar_preview').attr('src', previewUrl).show();
            });
            frame.open();
        });
        $('#nishiki_remove_avatar_btn').on('click', function(e) {
            e.preventDefault();
            $('#nishiki_local_avatar_id').val('');
            $('#nishiki_local_avatar_preview').attr('src', '').hide();
        });
    });
    </script>
    <?php
}
add_action( 'show_user_profile', 'nishiki_avatar_profile_fields' );
add_action( 'edit_user_profile', 'nishiki_avatar_profile_fields' );

/**
 * ローカルアバター: プロフィール保存時にuser metaを更新
 */
function nishiki_save_local_avatar( $user_id ) {
    if ( ! current_user_can( 'edit_user', $user_id ) ) {
        return;
    }
    if ( ! isset( $_POST['nishiki_avatar_nonce'] ) || ! wp_verify_nonce( $_POST['nishiki_avatar_nonce'], 'nishiki_avatar_save' ) ) {
        return;
    }
    if ( isset( $_POST['nishiki_local_avatar_id'] ) ) {
        $attachment_id = absint( $_POST['nishiki_local_avatar_id'] );
        if ( $attachment_id ) {
            update_user_meta( $user_id, 'nishiki_local_avatar_id', $attachment_id );
        } else {
            delete_user_meta( $user_id, 'nishiki_local_avatar_id' );
        }
    }
}
add_action( 'personal_options_update', 'nishiki_save_local_avatar' );
add_action( 'edit_user_profile_update', 'nishiki_save_local_avatar' );

/**
 * ローカルアバター: get_avatar() をローカル画像で上書き
 */
add_filter( 'pre_get_avatar_data', function( $args, $id_or_email ) {
    $user_id = 0;
    if ( is_numeric( $id_or_email ) ) {
        $user_id = (int) $id_or_email;
    } elseif ( $id_or_email instanceof WP_User ) {
        $user_id = $id_or_email->ID;
    } elseif ( is_string( $id_or_email ) ) {
        $user = get_user_by( 'email', $id_or_email );
        if ( $user ) {
            $user_id = $user->ID;
        }
    }

    if ( ! $user_id ) {
        return $args;
    }

    $attachment_id = get_user_meta( $user_id, 'nishiki_local_avatar_id', true );
    if ( ! $attachment_id ) {
        return $args;
    }

    $size = isset( $args['size'] ) ? (int) $args['size'] : 96;
    $image_url = wp_get_attachment_image_url( (int) $attachment_id, [ $size, $size ] );
    if ( ! $image_url ) {
        return $args;
    }

    $args['url']          = $image_url;
    $args['found_avatar'] = true;
    return $args;
}, 10, 2 );

<?php
/**
 * AuraWP Theme Functions
 */

if (!function_exists('aurawp_setup')) :
    function aurawp_setup() {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
        add_theme_support('custom-logo', [
            'height'      => 60,
            'width'       => 200,
            'flex-height' => true,
            'flex-width'  => true,
        ]);
        register_nav_menus([
            'primary' => esc_html__('Primary Menu', 'aurawp'),
        ]);
    }
endif;
add_action('after_setup_theme', 'aurawp_setup');

// 启用会话（用于验证码）
if (!session_id()) {
    session_start();
}

// 生成验证码
function aurawp_generate_captcha() {
    $code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 5);
    $_SESSION['download_captcha'] = strtolower($code);
    return $code;
}

// 验证验证码
function aurawp_verify_captcha($input) {
    if (!isset($_SESSION['download_captcha'])) return false;
    return strtolower(trim($input)) === $_SESSION['download_captcha'];
}

// 注册下载页面模板
function aurawp_add_download_template($templates) {
    $templates['page-download.php'] = '下载页面';
    return $templates;
}
add_filter('theme_page_templates', 'aurawp_add_download_template');

function aurawp_scripts() {
    wp_enqueue_style('aurawp-style', get_template_directory_uri() . '/assets/css/style.min.css', [], '2.0');
    
    // 默认配色：参考 Astra / Kadence 等高分主题
    $accent = get_theme_mod('aurawp_accent_color', '#1abc9c');
    $body_bg = get_theme_mod('aurawp_body_bg', '#f4f6f9');
    $content_bg = get_theme_mod('aurawp_content_bg', '#ffffff');
    $text_color = get_theme_mod('aurawp_text_color', '#3a4149');

    wp_add_inline_style('aurawp-style', ":root {
        --accent: {$accent};
        --accent-hover: " . aurawp_adjust_color($accent, -12) . ";
        --body-bg: {$body_bg};
        --content-bg: {$content_bg};
        --text-color: {$text_color};
        --text-light: #6b7280;
        --border-color: #e0e5eb;
        --shadow: 0 4px 12px rgba(0,0,0,0.05);
        --radius: 12px;
    }");

    wp_enqueue_script('aurawp-main', get_template_directory_uri() . '/assets/js/main.js', ['jquery'], '2.0', true);
    wp_localize_script('aurawp-main', 'aurawpData', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'is_home'  => is_front_page(),
    ]);
}
add_action('wp_enqueue_scripts', 'aurawp_scripts');

function aurawp_widgets_init() {
    register_sidebar([
        'name'          => esc_html__('Sidebar', 'aurawp'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'aurawp'),
        'before_widget' => '<section class="widget">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ]);
}
add_action('widgets_init', 'aurawp_widgets_init');

function aurawp_adjust_color($hex, $percent) {
    $hex = ltrim($hex, '#');
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex,0,1),2) . str_repeat(substr($hex,1,1),2) . str_repeat(substr($hex,2,1),2);
    }
    $r = hexdec(substr($hex,0,2));
    $g = hexdec(substr($hex,2,2));
    $b = hexdec(substr($hex,4,2));
    $r = max(0, min(255, $r + round($r * $percent / 100)));
    $g = max(0, min(255, $g + round($g * $percent / 100)));
    $b = max(0, min(255, $b + round($b * $percent / 100)));
    return sprintf("#%02X%02X%02X", $r, $g, $b);
}

// AJAX 刷新验证码
add_action('wp_ajax_nopriv_aurawp_refresh_captcha', 'aurawp_ajax_refresh_captcha');
add_action('wp_ajax_aurawp_refresh_captcha', 'aurawp_ajax_refresh_captcha');
function aurawp_ajax_refresh_captcha() {
    echo aurawp_generate_captcha();
    wp_die();
}

require get_template_directory() . '/inc/customizer.php';
// 主题基础支持
add_theme_support('post-thumbnails');
add_theme_support('title-tag');
add_theme_support('html5', ['search-form', 'comment-form', 'comment-list']);

// 浏览量统计（用于热门文章）
function aurawp_set_post_views() {
    if (!is_single()) return;
    $post_id = get_the_ID();
    $count_key = 'views';
    $count = get_post_meta($post_id, $count_key, true);
    if ($count == '') {
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
    } else {
        update_post_meta($post_id, $count_key, (int)$count + 1);
    }
}
add_action('wp_head', 'aurawp_set_post_views');

// 自定义摘要长度
function aurawp_custom_excerpt_length($length) {
    return 28;
}
add_filter('excerpt_length', 'aurawp_custom_excerpt_length', 999);

// 移除WordPress版本号
remove_action('wp_head', 'wp_generator');
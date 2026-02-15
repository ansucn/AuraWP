<?php
/**
 * AuraWP functions and definitions
 *
 * @package AuraWP
 */

// 启动 session（用于可能的下载统计）
if (!session_id()) {
    session_start();
}

// 主题设置
function aurawp_setup() {
    // 添加导航菜单支持 ←←← 新增此行
    register_nav_menus(array(
        'primary' => __('主菜单', 'aurawp'),
    ));

    // 添加文章缩略图支持
    add_theme_support('post-thumbnails');

    // 自动 feed 链接
    add_theme_support('automatic-feed-links');

    // 古腾堡编辑器样式支持
    add_theme_support('wp-block-styles');

    // 响应式嵌入内容
    add_theme_support('responsive-embeds');
}
add_action('after_setup_theme', 'aurawp_setup');

// 加载 CSS 和 JavaScript
function aurawp_scripts() {
    wp_enqueue_style('aurawp-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'aurawp_scripts');

// 自定义摘要长度（28字）
function aurawp_custom_excerpt_length($length) {
    return 28;
}
add_filter('excerpt_length', 'aurawp_custom_excerpt_length', 999);

// 浏览量统计
function get_post_views($post_id) {
    $count_key = 'views';
    $count = get_post_meta($post_id, $count_key, true);
    if ($count == '') {
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
        return "0";
    }
    return $count;
}

function set_post_views() {
    if (is_single()) {
        global $post;
        $post_id = $post->ID;
        $count_key = 'views';
        $count = get_post_meta($post_id, $count_key, true);
        if ($count == '') {
            $count = 0;
            delete_post_meta($post_id, $count_key);
            add_post_meta($post_id, $count_key, '0');
        } else {
            $count++;
            update_post_meta($post_id, $count_key, $count);
        }
    }
}
add_action('wp_head', 'set_post_views');

// 自动检测文章中的网盘链接
function aurawp_detect_download_links($content) {
    if (is_admin() || !in_the_loop() || !is_main_query()) {
        return $content;
    }

    $post_id = get_the_ID();
    if (!get_post_meta($post_id, '_auto_detected_links_processed', true)) {
        $links = array();

        // 百度网盘
        if (preg_match('/https?:\/\/pan\.baidu\.com\/(s|share)\/[a-zA-Z0-9]+/', $content, $matches)) {
            $links['baidu'] = $matches[0];
        }
        // 阿里云盘
        if (preg_match('/https?:\/\/www\.aliyundrive\.com\/s\/[a-zA-Z0-9]+/', $content, $matches)) {
            $links['aliyun'] = $matches[0];
        }
        // 蓝奏云
        if (preg_match('/https?:\/\/(www\.)?lanzou[w]?\.com\/[a-zA-Z0-9]+/', $content, $matches)) {
            $links['lanzou'] = $matches[0];
        }
        // 夸克网盘
        if (preg_match('/https?:\/\/pan\.quark\.cn\/s\/[a-zA-Z0-9]+/', $content, $matches)) {
            $links['quark'] = $matches[0];
        }
        // 城通网盘
        if (preg_match('/https?:\/\/[a-z0-9]+\.ctfile\.com\/[a-zA-Z0-9\/]+/', $content, $matches)) {
            $links['ctfile'] = $matches[0];
        }

        if (!empty($links)) {
            update_post_meta($post_id, '_auto_detected_links', $links);
        }
        update_post_meta($post_id, '_auto_detected_links_processed', '1');
    }

    return $content;
}
add_filter('the_content', 'aurawp_detect_download_links');

// 添加自定义字段到 REST API（用于古腾堡）
function aurawp_register_rest_fields() {
    register_rest_field('post', 'download_url', array(
        'get_callback' => function($post_arr) {
            return get_post_meta($post_arr['id'], 'download_url', true);
        },
        'update_callback' => null,
        'schema' => null,
    ));
}
add_action('rest_api_init', 'aurawp_register_rest_fields');
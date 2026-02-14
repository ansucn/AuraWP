<?php
function aurawp_customize_register($wp_customize) {
    $wp_customize->add_section('aurawp_colors', [
        'title'    => '主题颜色',
        'priority' => 30,
    ]);

    $wp_customize->add_setting('aurawp_accent_color', [
        'default'           => '#1abc9c',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'aurawp_accent_color', [
        'label'   => '强调色（链接/按钮）',
        'section' => 'aurawp_colors',
    ]));

    $wp_customize->add_setting('aurawp_body_bg', [
        'default'           => '#f4f6f9',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'aurawp_body_bg', [
        'label'   => '页面背景色',
        'section' => 'aurawp_colors',
    ]));

    $wp_customize->add_setting('aurawp_content_bg', [
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'aurawp_content_bg', [
        'label'   => '内容区域背景',
        'section' => 'aurawp_colors',
    ]));

    $wp_customize->add_setting('aurawp_text_color', [
        'default'           => '#3a4149',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'aurawp_text_color', [
        'label'   => '正文文字颜色',
        'section' => 'aurawp_colors',
    ]));
}
add_action('customize_register', 'aurawp_customize_register');
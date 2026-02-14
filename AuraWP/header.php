<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div class="site-wrapper">
        <header class="site-header <?php echo is_front_page() ? 'transparent' : ''; ?>">
            <div class="container flex-center">
                <!-- Logo -->
                <div class="logo">
                    <?php if (has_custom_logo()): ?>
                        <?php the_custom_logo(); ?>
                    <?php else: ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
                    <?php endif; ?>
                </div>

                <!-- 桌面导航 + 用户操作（仅在 >=768px 显示） -->
                <div class="desktop-nav">
                    <nav class="main-nav">
                        <?php
                        wp_nav_menu([
                            'theme_location' => 'primary',
                            'fallback_cb'    => false,
                            'container'      => false,
                            'menu_class'     => 'nav-menu'
                        ]);
                        ?>
                    </nav>
                    <div class="header-actions">
                        <?php if (is_user_logged_in()): ?>
                            <a href="<?php echo wp_logout_url(home_url()); ?>" class="btn btn-sm">退出</a>
                        <?php else: ?>
                            <a href="<?php echo wp_login_url(home_url()); ?>" class="btn btn-sm">登录</a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- 移动端菜单按钮 -->
                <button class="mobile-menu-toggle" aria-label="菜单">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </header>

        <!-- 移动端下拉菜单（默认隐藏） -->
        <div class="mobile-menu" id="mobileMenu">
            <nav>
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'fallback_cb'    => false,
                    'container'      => false,
                    'menu_class'     => 'mobile-nav-menu'
                ]);
                ?>
            </nav>
            <div class="mobile-user-actions">
                <?php if (is_user_logged_in()): ?>
                    <a href="<?php echo wp_logout_url(home_url()); ?>" class="btn btn-sm">退出</a>
                <?php else: ?>
                    <a href="<?php echo wp_login_url(home_url()); ?>" class="btn btn-sm">登录</a>
                <?php endif; ?>
            </div>
        </div>
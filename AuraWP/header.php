<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <style>
        * {
            box-sizing: border-box;
        }
        html, body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: #f9f9f9;
        }

        /* === 页眉固定，自动避开 admin bar === */
        .site-header {
            background: #2c3e50;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center; /* 🔥 关键：整体居中 */
            padding: 0 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 9999;
            flex-wrap: wrap;
            gap: 25px; /* 增加间距，更宽松 */
        }
        .admin-bar .site-header {
            top: 32px; /* WordPress 标准值 */
        }

        .site-logo a {
            color: white;
            font-size: 1.6rem;
            font-weight: bold;
            text-decoration: none;
            white-space: nowrap;
        }
        .main-navigation ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }
        .main-navigation li a {
            color: #ecf0f1;
            text-decoration: none;
            font-size: 1rem;
            padding: 6px 8px;
            white-space: nowrap;
            transition: color 0.2s;
        }
        .main-navigation li a:hover {
            color: #3498db;
        }
        .header-search form {
            display: flex;
            gap: 8px;
            white-space: nowrap;
        }
        .header-search input[type="text"] {
            width: 160px;
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            font-size: 0.9rem;
            background: #fff;
        }
        .header-search button {
            background: #3498db;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .site-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            margin-top: 80px;
        }
        .admin-bar .site-container {
            margin-top: 112px; /* 80 + 32 */
        }

        /* 首页大搜索 */
        .hero-search {
            text-align: center;
            margin: 2rem 0 2.5rem;
            padding: 1.5rem;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        .hero-search h2 {
            margin: 0 0 1rem;
            color: #2c3e50;
            font-size: 1.5rem;
        }
        .hero-search form {
            display: flex;
            justify-content: center;
            gap: 10px;
            max-width: 600px;
            margin: 0 auto;
            width: 100%;
        }
        .hero-search input[type="text"] {
            flex: 1;
            padding: 12px 16px;
            border: 2px solid #ced4da;
            border-radius: 30px;
            font-size: 1rem;
            outline: none;
            min-width: 0;
        }
        .hero-search button {
            background: #3498db;
            color: white;
            border: none;
            padding: 0 24px;
            border-radius: 30px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            white-space: nowrap;
        }

        @media (max-width: 900px) {
            .main-navigation ul { display: none; }
            .header-search input[type="text"] { width: 120px; }
        }
        @media (max-width: 500px) {
            .site-header {
                padding: 0 12px;
                height: auto;
                padding: 12px 12px;
                gap: 15px;
            }
            .header-search input[type="text"] { width: 100px; font-size: 0.85rem; }
            .header-search button { padding: 5px 8px; font-size: 0.85rem; }
            .hero-search form { flex-direction: column; }
            .hero-search input[type="text"],
            .hero-search button {
                width: 100%;
                border-radius: 8px;
            }
            .site-container {
                margin-top: 90px;
            }
            .admin-bar .site-container {
                margin-top: 122px;
            }
        }
    </style>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="site-logo">
        <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
    </div>
    <nav class="main-navigation">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'container' => false,
            'menu_class' => '',
            'items_wrap' => '<ul>%3$s</ul>',
            'depth' => 1,
            'fallback_cb' => 'aurawp_default_pages_menu'
        ));
        ?>
    </nav>
    <div class="header-search">
        <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
            <input type="text" name="s" placeholder="搜索..." value="<?php echo get_search_query(); ?>">
            <button type="submit">搜</button>
        </form>
    </div>
</header>

<div class="site-container">
<aside style="width:100%;max-width:340px;">
    <div style="background:#fff;padding:1.2rem;margin-bottom:1.4rem;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
        <?php if (is_user_logged_in()): ?>
            <?php $current_user = wp_get_current_user(); ?>
            <div style="text-align:center;margin-bottom:1rem;">
                <?php echo get_avatar($current_user->ID, 60); ?>
                <h3 style="margin:0.5rem 0;font-size:1.1rem;color:#2c3e50;"><?php echo esc_html($current_user->display_name); ?></h3>
                <p style="color:#7f8c8d;font-size:0.9rem;margin:0;">欢迎回来！</p>
            </div>
            <div style="display:flex;flex-direction:column;gap:0.7rem;">
                <a href="<?php echo admin_url(); ?>" style="padding:0.5rem 1rem;background:#3498db;color:white;text-align:center;border-radius:5px;text-decoration:none;font-size:0.95rem;">进入后台</a>
                <a href="<?php echo wp_logout_url(home_url()); ?>" style="padding:0.5rem 1rem;background:#e74c3c;color:white;text-align:center;border-radius:5px;text-decoration:none;font-size:0.95rem;">退出登录</a>
            </div>
        <?php else: ?>
            <div style="text-align:center;">
                <h3 style="margin:0 0 1rem;font-size:1.2rem;color:#2c3e50;">欢迎访问</h3>
                <a href="<?php echo wp_login_url(home_url()); ?>" style="display:inline-block;padding:0.6rem 1.2rem;background:#3498db;color:white;border-radius:5px;text-decoration:none;font-size:0.95rem;">登录 / 注册</a>
            </div>
        <?php endif; ?>
    </div>

    <div style="background:#fff;padding:1.2rem;margin-bottom:1.4rem;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.08);text-align:center;">
        <h3 style="font-size:1.2rem;margin:0 0 1rem;color:#2c3e50;border-bottom:1px solid #eee;padding-bottom:0.5rem;">日历</h3>
        <div style="display:inline-block;">
            <?php get_calendar(); ?>
        </div>
    </div>

    <div style="background:#fff;padding:1.2rem;margin-bottom:1.4rem;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
        <h3 style="font-size:1.2rem;margin:0 0 1rem;color:#2c3e50;border-bottom:1px solid #eee;padding-bottom:0.5rem;">热门文章</h3>
        <?php
        $popular_posts = new WP_Query(array(
            'posts_per_page' => 5,
            'meta_key' => 'views',
            'orderby' => 'meta_value_num',
            'order' => 'DESC'
        ));
        if ($popular_posts->have_posts()):
        ?>
            <ul style="list-style:none;padding:0;margin:0;">
                <?php while ($popular_posts->have_posts()): $popular_posts->the_post(); ?>
                    <li style="padding:0.5rem 0;border-bottom:1px dashed #f0f0f0;display:flex;justify-content:space-between;align-items:center;">
                        <a href="<?php the_permalink(); ?>" style="color:#34495e;text-decoration:none;font-size:0.95rem;"><?php echo wp_trim_words(get_the_title(), 8); ?></a>
                        <span style="color:#e74c3c;font-size:0.85rem;"><?php echo get_post_views(get_the_ID()); ?></span>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php endif; wp_reset_postdata(); ?>
    </div>

    <div style="background:#fff;padding:1.2rem;margin-bottom:1.4rem;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
        <h3 style="font-size:1.2rem;margin:0 0 1rem;color:#2c3e50;border-bottom:1px solid #eee;padding-bottom:0.5rem;">标签云</h3>
        <?php
        $tags = get_tags(array('number' => 20));
        if ($tags):
            echo '<div style="display:flex;flex-wrap:wrap;gap:0.5rem;justify-content:center;">';
            foreach ($tags as $tag) {
                $color = '#' . substr(dechex(mt_rand(0x100000, 0xFFFFFF)), 0, 6);
                echo '<a href="' . get_tag_link($tag->term_id) . '" style="background:' . $color . ';color:white;padding:0.3rem 0.6rem;border-radius:12px;font-size:0.85rem;text-decoration:none;">' . $tag->name . '</a>';
            }
            echo '</div>';
        endif;
        ?>
    </div>
</aside>
<aside class="sidebar" style="margin-top: 2rem;">
    <!-- 用户信息 -->
    <div class="widget widget_user_info card" style="margin-bottom: 1.5rem; padding: 1.2rem;">
        <h3 style="margin: 0 0 1rem; font-size: 1.1rem; color: #2c3e50;">账户中心</h3>

        <?php if (is_user_logged_in()) : ?>
            <?php
            $current_user = wp_get_current_user();
            $avatar = get_avatar($current_user->ID, 60);
            ?>
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 1rem;">
                <div><?php echo $avatar; ?></div>
                <div>
                    <div style="font-weight: bold; color: #2c3e50;"><?php echo esc_html($current_user->display_name); ?></div>
                    <div style="font-size: 0.85rem; color: #777;">欢迎回来！</div>
                </div>
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.6rem;">
                <a href="<?php echo admin_url(); ?>" style="color: #3498db; text-decoration: none; font-size: 0.95rem;">⚙️ 后台管理</a>
                <a href="<?php echo get_edit_profile_url(); ?>" style="color: #3498db; text-decoration: none; font-size: 0.95rem;">👤 个人资料</a>
                <a href="<?php echo wp_logout_url(home_url()); ?>" style="color: #e74c3c; text-decoration: none; font-size: 0.95rem;">🚪 退出登录</a>
            </div>
        <?php else : ?>
            <p style="margin: 0 0 1rem; color: #666;">您尚未登录。</p>
            <a href="<?php echo wp_login_url(get_permalink()); ?>" 
               style="display: inline-block; background: #3498db; color: white; text-decoration: none; padding: 0.5rem 1rem; border-radius: 6px; font-size: 0.95rem;">
                🔑 立即登录
            </a>
        <?php endif; ?>
    </div>

    <!-- 日历 -->
    <div class="widget widget_calendar card" style="margin-bottom: 1.5rem; padding: 1.2rem;">
        <h3 style="margin: 0 0 1rem; font-size: 1.1rem; color: #2c3e50;">📅 文章日历</h3>
        <?php get_calendar(); ?>
    </div>

    <!-- 热门文章 -->
    <div class="widget widget_hot_posts card" style="margin-bottom: 1.5rem; padding: 1.2rem;">
        <h3 style="margin: 0 0 1rem; font-size: 1.1rem; color: #2c3e50;">🔥 热门资源</h3>
        <ul style="list-style: none; padding: 0; margin: 0;">
            <?php
            $hot_posts = new WP_Query([
                'posts_per_page' => 5,
                'meta_key' => 'views',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'post_status' => 'publish'
            ]);
            if ($hot_posts->have_posts()) :
                while ($hot_posts->have_posts()) : $hot_posts->the_post();
                    $views = get_post_meta(get_the_ID(), 'views', true) ?: 0;
                    ?>
                    <li style="padding: 0.6rem 0; border-bottom: 1px dashed #eee; margin: 0;">
                        <a href="<?php the_permalink(); ?>" style="color: #333; text-decoration: none; display: block; line-height: 1.4;">
                            <?php echo wp_trim_words(get_the_title(), 12, '...'); ?>
                        </a>
                        <div style="font-size: 0.85rem; color: #888; margin-top: 0.3rem;">
                            👁️ <?php echo number_format_i18n($views); ?> 次浏览
                        </div>
                    </li>
                    <?php
                endwhile;
                wp_reset_postdata();
            else:
                echo '<li>暂无热门文章</li>';
            endif;
            ?>
        </ul>
    </div>

    <!-- 标签云 -->
    <div class="widget widget_tag_cloud card" style="margin-bottom: 1.5rem; padding: 1.2rem;">
        <h3 style="margin: 0 0 1rem; font-size: 1.1rem; color: #2c3e50;">🏷️ 热门标签</h3>
        <div style="display: flex; flex-wrap: wrap; gap: 0.4rem;">
            <?php
            $tags = get_tags(['number' => 20, 'orderby' => 'count', 'order' => 'DESC']);
            if ($tags) {
                foreach ($tags as $tag) {
                    $color = sprintf('#%06x', mt_rand(0x3498db, 0xe74c3c));
                    echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" 
                          style="background: ' . $color . '; color: white; padding: 0.3rem 0.6rem; border-radius: 20px; font-size: 0.85rem; text-decoration: none; opacity: 0.9;"
                          onmouseover="this.style.opacity=\'1\'"
                          onmouseout="this.style.opacity=\'0.9\'">' .
                          esc_html($tag->name) . ' (' . $tag->count . ')' .
                          '</a>';
                }
            } else {
                echo '<span>暂无标签</span>';
            }
            ?>
        </div>
    </div>
</aside>
<?php get_header(); ?>

<div class="container" style="padding: 2rem 0;">
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; max-width: 1200px; margin: 0 auto;">
        
        <main class="main-content">
            <?php while (have_posts()) : the_post(); ?>
                <article class="card" style="padding: 2rem;">
                    <header style="margin-bottom: 1.5rem;">
                        <h1 style="font-size: 2rem; line-height: 1.3; color: #2c3e50; margin: 0 0 0.8rem;"><?php the_title(); ?></h1>
                        
                        <div style="display: flex; flex-wrap: wrap; gap: 0.6rem; font-size: 0.9rem; color: #777; margin-bottom: 1rem;">
                            <span>📅 <?php echo get_the_date('Y-m-d'); ?></span>
                            <span>👤 <?php the_author(); ?></span>
                            <span>📁 
                                <?php
                                $categories = get_the_category();
                                if ($categories) {
                                    echo join(', ', wp_list_pluck($categories, 'name'));
                                }
                                ?>
                            </span>
                            <?php if (has_tag()) : ?>
                                <span>🏷️ <?php the_tags('', ', '); ?></span>
                            <?php endif; ?>
                        </div>

                        <?php if (has_post_thumbnail()) : ?>
                            <div style="margin: 1.5rem 0;">
                                <?php the_post_thumbnail('large', ['style' => 'width:100%; border-radius: 8px;']); ?>
                            </div>
                        <?php endif; ?>
                    </header>

                    <div class="post-content" style="line-height: 1.8; font-size: 1.05rem; color: #333;">
                        <?php the_content(); ?>
                    </div>

                    <?php
                    $download_url = get_field('download_url');
                    if ($download_url && filter_var($download_url, FILTER_VALIDATE_URL)) :
                    ?>
                        <div style="margin: 2rem 0; padding: 1.2rem; background: #f8f9fa; border-radius: 10px; text-align: center;">
                            <a href="<?php echo esc_url(home_url('/download/?post=' . get_the_ID())); ?>" 
                               class="download-btn" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               style="display: inline-block; background: #3498db; color: white; padding: 0.6rem 1.5rem; border-radius: 6px; font-weight: bold; font-size: 1.1rem;">
                                💾 点击进入下载页面
                            </a>
                        </div>
                    <?php endif; ?>

                    <!-- 赞助模块 -->
                    <div class="post-sponsor" style="margin: 3rem 0; padding: 1.5rem; background: #f8f9fa; border-radius: 12px; text-align: center;">
                        <h3 style="color: #e74c3c; margin: 0 0 1rem;">❤️ 觉得有用？请作者喝杯奶茶吧！</h3>
                        <p style="color: #666; margin-bottom: 1.2rem;">您的支持是我持续创作的最大动力～</p>
                        
                        <button id="showDonateModal" class="btn-donate" 
                                style="background: #e74c3c; color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 30px; font-size: 1rem; cursor: pointer; box-shadow: 0 2px 6px rgba(231, 76, 60, 0.3);">
                            💝 立即赞助
                        </button>
                    </div>

                </article>

                <?php if (comments_open() || get_comments_number()) comments_template(); ?>

            <?php endwhile; ?>
        </main>

        <aside class="sidebar">
            <?php get_sidebar(); ?>
        </aside>

    </div>
</div>

<!-- 赞助模态框 -->
<div id="donateModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 9999; justify-content: center; align-items: center;">
    <div style="background: white; padding: 1.5rem; border-radius: 16px; max-width: 90%; width: 320px; text-align: center; position: relative;">
        <button id="closeModal" style="position: absolute; top: 10px; right: 15px; background: none; border: none; font-size: 1.4rem; cursor: pointer;">&times;</button>
        <h3 style="margin-top: 0; color: #2c3e50;">感谢您的支持！</h3>
        
        <div style="display: flex; justify-content: space-around; margin: 1.2rem 0;">
            <div>
                <p style="margin: 0 0 0.5rem; font-size: 0.9rem;">微信扫</p>
                <img src="https://moonglade.cc/wp-content/uploads/2026/02/wechat-pay.png" alt="微信收款码" style="width: 120px; height: 120px; object-fit: cover; border: 1px solid #eee; border-radius: 8px;">
            </div>
            <div>
                <p style="margin: 0 0 0.5rem; font-size: 0.9rem;">支付宝扫</p>
                <img src="https://moonglade.cc/wp-content/uploads/2026/02/alipay.png" alt="支付宝收款码" style="width: 120px; height: 120px; object-fit: cover; border: 1px solid #eee; border-radius: 8px;">
            </div>
        </div>
        
        <p style="font-size: 0.85rem; color: #888; margin: 0;">
            扫码后输入任意金额即可 ❤️
        </p>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('donateModal');
    const btn = document.getElementById('showDonateModal');
    const close = document.getElementById('closeModal');

    if (btn) btn.onclick = () => modal.style.display = 'flex';
    if (close) close.onclick = () => modal.style.display = 'none';
    
    window.onclick = (e) => {
        if (e.target === modal) modal.style.display = 'none';
    };
});
</script>

<?php get_footer(); ?>
<?php get_header(); ?>

<main style="display:grid;grid-template-columns:2fr 1fr;gap:2rem;margin-bottom:3rem;">
    <article style="background:#fff;padding:2rem;border-radius:10px;box-shadow:0 3px 10px rgba(0,0,0,0.06);">
        <h1 style="font-size:2rem;margin:0 0 1rem;color:#2c3e50;"><?php the_title(); ?></h1>
        <div style="color:#7f8c8d;font-size:0.95rem;margin-bottom:2rem;display:flex;gap:1rem;flex-wrap:wrap;">
            <span>作者：<?php the_author(); ?></span>
            <span>发布时间：<?php the_time('Y-m-d'); ?></span>
            <span>浏览量：<?php echo get_post_views(get_the_ID()); ?></span>
        </div>

        <?php if (has_post_thumbnail()): ?>
            <div style="margin-bottom:2rem;">
                <?php the_post_thumbnail('large', ['style' => 'width:100%;height:auto;border-radius:8px;']); ?>
            </div>
        <?php endif; ?>

        <div style="margin-bottom:2rem;line-height:1.8;color:#34495e;">
            <?php the_content(); ?>
        </div>

        <?php
        $manual_url = get_post_meta(get_the_ID(), 'download_url', true);
        $auto_links = get_post_meta(get_the_ID(), '_auto_detected_links', true);
        if ($manual_url || (!empty($auto_links) && is_array($auto_links))):
        ?>
            <div style="text-align:center;margin:2rem 0;">
                <a href="/download/?post=<?php the_ID(); ?>" 
                   style="display:inline-block;background:#e74c3c;color:white;padding:0.8rem 2rem;border-radius:8px;text-decoration:none;font-size:1.1rem;font-weight:bold;box-shadow:0 4px 12px rgba(231,76,60,0.3);">
                    进入下载页
                </a>
            </div>
        <?php endif; ?>

        <div style="text-align:center;margin:2rem 0;">
            <button onclick="openSponsorModal()" 
                    style="background:#f39c12;color:white;padding:0.6rem 1.5rem;border:none;border-radius:6px;cursor:pointer;font-size:1rem;box-shadow:0 3px 8px rgba(243,156,18,0.4);">
                赞助本站 ❤️
            </button>
        </div>
    </article>

    <?php get_sidebar(); ?>
</main>

<!-- 赞助弹窗 -->
<div id="sponsorModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.7);z-index:9999;justify-content:center;align-items:center;">
    <div style="background:white;padding:2rem;border-radius:15px;text-align:center;max-width:400px;width:90%;">
        <h3 style="margin-top:0;color:#2c3e50;">感谢您的支持！</h3>
        <p style="color:#7f8c8d;margin-bottom:1.5rem;">请选择支付方式：</p>
        
        <div style="display:flex;justify-content:center;gap:1rem;margin-bottom:1.5rem;">
            <button onclick="switchPayMethod('wechat')" style="padding:0.4rem 1rem;background:#2ecc71;color:white;border:none;border-radius:5px;cursor:pointer;" id="btn-wechat">微信</button>
            <button onclick="switchPayMethod('alipay')" style="padding:0.4rem 1rem;background:#3498db;color:white;border:none;border-radius:5px;cursor:pointer;" id="btn-alipay">支付宝</button>
        </div>

        <div id="qrcodeContainer" style="margin:1.5rem 0;display:flex;justify-content:center;align-items:center;min-height:240px;">
            <img src="<?php echo get_template_directory_uri(); ?>/images/wechat-pay.png" alt="微信赞赏码" id="wechatQR" style="max-width:220px;height:auto;border-radius:8px;box-shadow:0 4px 12px rgba(0,0,0,0.15);">
            <img src="<?php echo get_template_directory_uri(); ?>/images/alipay.png" alt="支付宝赞赏码" id="alipayQR" style="max-width:220px;height:auto;border-radius:8px;box-shadow:0 4px 12px rgba(0,0,0,0.15);display:none;">
        </div>

        <p style="color:#e74c3c;font-size:0.9rem;margin-bottom:1.5rem;">打赏后可联系站长获取额外资源或技术支持</p>
        <button onclick="closeSponsorModal()" style="padding:0.5rem 1.5rem;background:#e74c3c;color:white;border:none;border-radius:5px;cursor:pointer;">关闭</button>
    </div>
</div>

<script>
function openSponsorModal() {
    document.getElementById('sponsorModal').style.display = 'flex';
}
function closeSponsorModal() {
    document.getElementById('sponsorModal').style.display = 'none';
}
function switchPayMethod(method) {
    const wechatBtn = document.getElementById('btn-wechat');
    const alipayBtn = document.getElementById('btn-alipay');
    const wechatQR = document.getElementById('wechatQR');
    const alipayQR = document.getElementById('alipayQR');

    if (method === 'wechat') {
        wechatBtn.style.background = '#2ecc71';
        alipayBtn.style.background = '#3498db';
        wechatQR.style.display = 'block';
        alipayQR.style.display = 'none';
    } else {
        alipayBtn.style.background = '#2ecc71';
        wechatBtn.style.background = '#3498db';
        alipayQR.style.display = 'block';
        wechatQR.style.display = 'none';
    }
}
document.getElementById('sponsorModal').onclick = function(e) {
    if (e.target === this) closeSponsorModal();
};
</script>

<!-- ✅ 关键：加载 WordPress 评论系统 -->
<?php
if (comments_open() || get_comments_number()) {
    comments_template();
}
?>

<?php get_footer(); ?>
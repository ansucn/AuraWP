<?php
/**
 * Template Name: 资源下载页面（增强版）
 */
get_header();

if (!session_id()) session_start();

function aurawp_generate_captcha() {
    $code = substr(str_shuffle("23456789ABCDEFGHJKLMNPQRSTUVWXYZ"), 0, 5);
    $_SESSION['download_captcha'] = strtolower($code);
}

$post_id = isset($_GET['post']) ? intval($_GET['post']) : 0;
$download_url = $post_id ? get_field('download_url', $post_id) : '';
$extraction_code = $post_id ? get_field('extraction_code', $post_id) : '';
$is_paid = $post_id ? get_field('is_paid', $post_id) : false;

$error = '';
if ($_POST && $post_id && !empty($download_url)) {
    $input = sanitize_text_field($_POST['captcha'] ?? '');
    if (isset($_SESSION['download_captcha']) && strtolower(trim($input)) === $_SESSION['download_captcha']) {
        wp_redirect(esc_url_raw($download_url));
        exit;
    } else {
        $error = '验证码错误，请重试。';
        aurawp_generate_captcha();
    }
} else {
    if (!isset($_SESSION['download_captcha'])) {
        aurawp_generate_captcha();
    }
}
?>

<div class="container" style="padding: 2rem 0;">
    <div class="download-page card" style="max-width: 700px; margin: 0 auto; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
        
        <h1 style="text-align: center; margin-bottom: 1.5rem; color: #2c3e50;">📥 资源下载</h1>

        <?php if (!$post_id || empty($download_url)): ?>
            <div class="alert alert-error" style="background: #ffebee; color: #c62828; padding: 1rem; border-radius: 8px; text-align: center;">
                ❌ 无效的下载请求。
            </div>
        <?php else: ?>

            <div class="download-info" style="margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px dashed #eee;">
                <?php if ($is_paid): ?>
                    <div class="permission-badge" style="background: #fff8e1; color: #ff8f00; padding: 0.4rem 0.8rem; border-radius: 20px; display: inline-block; font-size: 0.9rem; margin-bottom: 0.8rem;">
                        💰 本资源为付费内容
                    </div>
                <?php else: ?>
                    <div class="permission-badge" style="background: #e8f5e9; color: #2e7d32; padding: 0.4rem 0.8rem; border-radius: 20px; display: inline-block; font-size: 0.9rem; margin-bottom: 0.8rem;">
                        🆓 免费资源 · 请遵守版权协议
                    </div>
                <?php endif; ?>

                <?php if ($extraction_code): ?>
                    <p><strong>🔑 提取码：</strong><code style="background: #f5f5f5; padding: 0.2rem 0.4rem; border-radius: 4px;"><?php echo esc_html($extraction_code); ?></code></p>
                <?php endif; ?>

                <p style="font-size: 0.9rem; color: #666; margin-top: 1rem;">
                    ⚠️ 本资源由用户分享，仅供学习交流使用。  
                    请于下载后 24 小时内删除，勿用于商业用途。
                </p>
            </div>

            <div class="download-ad" style="margin: 1.5rem 0; text-align: center; font-size: 0.85rem; color: #888;">
                📢 推广位：您的广告可放在这里（联系站长）
            </div>

            <?php if ($error): ?>
                <div class="alert alert-error" style="background: #ffebee; color: #c62828; padding: 0.8rem; border-radius: 8px; margin-bottom: 1rem;">
                    <?php echo esc_html($error); ?>
                </div>
            <?php endif; ?>

            <form method="post" style="margin-top: 1rem;">
                <p style="text-align: center; margin-bottom: 1rem;">为防止滥用，请输入下方验证码以继续访问下载链接：</p>

                <div class="captcha-section" style="display: flex; justify-content: center; align-items: center; gap: 12px; margin: 1.5rem 0; flex-wrap: wrap;">
                    <div class="captcha-display" style="font-size: 1.8rem; font-weight: bold; letter-spacing: 4px; background: #f8f9fa; padding: 0.6rem 1.2rem; border-radius: 10px; min-width: 130px; text-align: center; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
                        <?php echo isset($_SESSION['download_captcha']) ? strtoupper($_SESSION['download_captcha']) : 'ERROR'; ?>
                    </div>
                    <button type="button" class="refresh-captcha btn" style="background: #e9ecef; border: 1px solid #dee2e6; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;" title="换一张" onclick="location.reload();">
                        🔄
                    </button>
                </div>

                <input type="text" name="captcha" class="captcha-input" 
                       placeholder="请输入验证码（不区分大小写）" 
                       required autocomplete="off"
                       style="width: 100%; max-width: 300px; margin: 0 auto; display: block; padding: 0.75rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem; text-align: center;">

                <button type="submit" class="btn btn-primary" 
                        style="width: 100%; max-width: 300px; margin: 1.5rem auto 0; display: block; background: #4CAF50; color: white; border: none; padding: 0.8rem; border-radius: 8px; font-size: 1.1rem; cursor: pointer;">
                    ✅ 验证并跳转下载
                </button>
            </form>

            <?php if ($is_paid): ?>
                <div class="payment-section" style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px dashed #eee; text-align: center;">
                    <h3>💰 如何获取下载权限？</h3>
                    <p>请联系站长购买资源，支持微信/支付宝付款。</p>
                    <p style="font-size: 0.9rem; color: #888; margin-top: 1rem;">
                        付款后请提供文章 ID，我们将手动为您开通权限。
                    </p>
                </div>
            <?php endif; ?>

        <?php endif; ?>

        <div class="copyright" style="margin-top: 2.5rem; padding-top: 1.5rem; border-top: 1px solid #eee; text-align: center; font-size: 0.85rem; color: #999;">
            &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. 保留所有权利。<br>
            未经许可，禁止转载或用于商业用途。
        </div>

    </div>
</div>

<?php get_footer(); ?>
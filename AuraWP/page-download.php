<?php
/**
 * Template Name: 下载页面
 * 
 * 修复说明：
 * 1. 添加 session_start() 双重保险
 * 2. 修复验证码验证逻辑
 */
get_header(); 

// 确保 session 已启动（关键修复）
if (!session_id()) {
    session_start();
}

$post_id = isset($_GET['post']) ? intval($_GET['post']) : 0;

// 修复后的验证码验证（安全类型转换）
$verified = false;
if (isset($_POST['captcha']) && !empty($_SESSION['captcha_code'])) {
    $verified = (trim($_POST['captcha']) === (string)$_SESSION['captcha_code']);
}
?>

<div class="container" style="max-width: 800px; margin: 2rem auto; padding: 0 1rem;">
    <h1 style="text-align: center; margin-bottom: 2rem; color: #2c3e50;">资源下载</h1>
    
    <?php
    if (!$post_id) {
        echo '<div style="background: #ffebee; padding: 1.5rem; border-radius: 8px; text-align: center; color: #c62828;">无效的下载请求</div>';
        get_footer();
        exit;
    }
    
    $post = get_post($post_id);
    if (!$post || $post->post_status !== 'publish') {
        echo '<div style="background: #ffebee; padding: 1.5rem; border-radius: 8px; text-align: center; color: #c62828;">资源不存在或已被删除</div>';
        get_footer();
        exit;
    }
    
    if (!$verified) {
        // 生成新验证码
        $_SESSION['captcha_code'] = rand(1000, 9999);
        ?>
        <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
            <h2 style="margin-top: 0; color: #3498db;"><?php echo esc_html($post->post_title); ?></h2>
            <p style="color: #666; margin-bottom: 1.5rem;">请输入下方验证码以获取下载链接</p>
            
            <form method="POST" style="display: flex; flex-direction: column; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <input type="text" 
                           name="captcha" 
                           placeholder="输入验证码" 
                           required
                           style="flex: 1; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px; font-size: 1.1rem;">
                    <div style="font-size: 1.5rem; font-weight: bold; background: #f8f9fa; padding: 0.5rem 1rem; border-radius: 6px;">
                        <?php echo $_SESSION['captcha_code']; ?>
                    </div>
                </div>
                <button type="submit" 
                        style="background: #3498db; color: white; padding: 0.75rem; border: none; border-radius: 6px; font-size: 1.1rem; cursor: pointer;">
                    验证并获取下载链接
                </button>
            </form>
        </div>
        <?php
    } else {
        // 验证通过，显示链接
        $download_links = get_post_meta($post_id, '_auto_detected_links', true);
        $manual_url = get_post_meta($post_id, 'download_url', true);
        $extraction_code = get_post_meta($post_id, 'extraction_code', true);
        
        if (empty($download_links)) {
            if ($manual_url && filter_var($manual_url, FILTER_VALIDATE_URL)) {
                $download_links = [$manual_url];
            }
        }
        
        if (empty($download_links)) {
            echo '<div style="background: #fff8e1; padding: 1.5rem; border-radius: 8px; text-align: center; color: #e65100;">该资源暂无有效下载链接</div>';
        } else {
            ?>
            <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                <h2 style="margin-top: 0; color: #27ae60;"><?php echo esc_html($post->post_title); ?></h2>
                
                <div style="margin: 1.5rem 0;">
                    <h3 style="color: #2c3e50; margin-bottom: 1rem;">可用下载链接：</h3>
                    <?php foreach ($download_links as $link): ?>
                        <div style="margin-bottom: 0.75rem; padding: 0.75rem; background: #f8f9fa; border-radius: 6px;">
                            <a href="<?php echo esc_url($link); ?>" 
                               target="_blank" 
                               rel="noopener"
                               style="color: #3498db; text-decoration: none; font-weight: bold;">
                                <?php
                                $host = parse_url($link, PHP_URL_HOST);
                                if (strpos($host, 'baidu') !== false) {
                                    echo '📁 百度网盘';
                                } elseif (strpos($host, 'quark') !== false) {
                                    echo '📁 夸克网盘';
                                } elseif (strpos($host, 'aliyun') !== false || strpos($host, 'alicloud') !== false) {
                                    echo '📁 阿里云盘';
                                } elseif (strpos($host, 'uc.cn') !== false) {
                                    echo '📁 UC网盘';
                                } elseif (strpos($host, '123pan') !== false) {
                                    echo '📁 123网盘';
                                } elseif (strpos($host, 'lanzou') !== false) {
                                    echo '📁 蓝奏云';
                                } else {
                                    echo '📁 下载链接';
                                }
                                ?>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <?php if ($extraction_code): ?>
                    <div style="background: #e8f4fd; padding: 1rem; border-radius: 6px; margin-top: 1rem;">
                        <strong>🔑 提取码：</strong>
                        <span style="font-size: 1.2rem; font-weight: bold; color: #e74c3c;"><?php echo esc_html($extraction_code); ?></span>
                    </div>
                <?php endif; ?>
                
                <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #eee; color: #7f8c8d; font-size: 0.9rem;">
                    <p>💡 提示：点击链接后如需提取码，请在上方查看</p>
                    <p>🔒 本页面已通过验证码保护，防止资源滥用</p>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>

<?php get_footer(); ?>
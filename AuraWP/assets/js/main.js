jQuery(document).ready(function($) {
    // 移动端菜单
    const toggle = document.querySelector('.mobile-menu-toggle');
    const menu = document.getElementById('mobileMenu');
    if (toggle && menu) {
        toggle.addEventListener('click', () => {
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        });
        document.addEventListener('click', (e) => {
            if (!toggle.contains(e.target) && !menu.contains(e.target) && menu.style.display === 'block') {
                menu.style.display = 'none';
            }
        });
    }

    // 首页滚动
    const header = document.querySelector('.site-header');
    if (header && aurawpData.is_home) {
        let lastScrollTop = 0;
        window.addEventListener('scroll', () => {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            if (scrollTop > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
            lastScrollTop = scrollTop;
        });
    }

    // 刷新验证码
    $('.refresh-captcha').on('click', function() {
        $.post(aurawpData.ajax_url, {
            action: 'aurawp_refresh_captcha'
        }, function(data) {
            $('.captcha-display').text(data);
        });
    });

    // 下载表单提交
    $('#download-form').on('submit', function(e) {
        e.preventDefault();
        const input = $(this).find('.captcha-input').val();
        const postId = $(this).data('post-id');
        
        $.post(aurawpData.ajax_url, {
            action: 'aurawp_verify_download',
            captcha: input,
            post_id: postId
        }, function(response) {
            if (response.success) {
                $('.download-error').hide();
                $('.download-success').show().text('验证成功！正在跳转...');
                setTimeout(() => {
                    window.location.href = response.data.download_url;
                }, 1000);
            } else {
                $('.download-success').hide();
                $('.download-error').show().text(response.data.message || '验证码错误，请重试。');
                $('.refresh-captcha').click(); // 自动刷新
            }
        });
    });
});

// 后台验证下载（需在 functions.php 中添加）
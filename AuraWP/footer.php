</div><!-- .site-container -->

<footer style="background:#2c3e50;color:white;padding:2.5rem 5%;margin-top:3rem;">
    <div style="max-width:1200px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:2rem;">
        <div>
            <h3 style="font-size:1.3rem;margin-bottom:1rem;color:#3498db;">关于本站</h3>
            <p style="line-height:1.6;font-size:0.95rem;color:#ecf0f1;">
                本站致力于分享优质资源与技术教程，欢迎关注与支持！
            </p>
        </div>
        <div>
            <h3 style="font-size:1.3rem;margin-bottom:1rem;color:#3498db;">快速链接</h3>
            <ul style="list-style:none;padding:0;">
                <li style="margin-bottom:0.5rem;"><a href="/" style="color:#bdc3c7;text-decoration:none;">首页</a></li>
                <li style="margin-bottom:0.5rem;"><a href="/about" style="color:#bdc3c7;text-decoration:none;">关于我们</a></li>
                <li style="margin-bottom:0.5rem;"><a href="/contact" style="color:#bdc3c7;text-decoration:none;">联系我们</a></li>
            </ul>
        </div>
        <div>
            <h3 style="font-size:1.3rem;margin-bottom:1rem;color:#3498db;">分类浏览</h3>
            <?php
            $categories = get_categories(['number' => 5]);
            echo '<ul style="list-style:none;padding:0;">';
            foreach ($categories as $cat) {
                echo '<li style="margin-bottom:0.5rem;"><a href="' . get_category_link($cat->term_id) . '" style="color:#bdc3c7;text-decoration:none;">' . $cat->name . '</a></li>';
            }
            echo '</ul>';
            ?>
        </div>
        <div>
            <h3 style="font-size:1.3rem;margin-bottom:1rem;color:#3498db;">关注我们</h3>
            <p style="color:#ecf0f1;font-size:0.95rem;">微信公众号：xxx</p>
            <p style="color:#e74c3c;font-size:0.9rem;margin-top:0.5rem;">赞助支持 ❤️</p>
        </div>
    </div>
    <div style="max-width:1200px;margin:2rem auto 0;text-align:center;color:#bdc3c7;font-size:0.9rem;border-top:1px solid #34495e;padding-top:1.5rem;">
        &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. 保留所有权利。
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
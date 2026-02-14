<?php
/**
 * The template for displaying the footer
 */
?>

	</div><!-- #page -->

	<footer class="site-footer" style="
		background: #f9fafb;
		border-top: 1px solid #eee;
		padding: 2rem 0 1.5rem;
		margin-top: 3rem;
		font-size: 0.95rem;
		color: #666;
	">
		<div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 1.5rem;">
			<div class="footer-content" style="display: flex; flex-wrap: wrap; justify-content: space-between; gap: 1.5rem;">
				
				<div class="footer-site-info" style="flex: 1; min-width: 250px;">
					<h3 style="margin: 0 0 1rem; font-size: 1.2rem; color: #2c3e50;">月光林地资源站</h3>
					<p style="line-height: 1.6; margin: 0;">
						专注于 WordPress 主题、插件与数字资源分享，  
						为开发者与内容创作者提供高质量工具。
					</p>
				</div>

				<div class="footer-contact" style="flex: 0 0 auto; min-width: 200px;">
					<h4 style="margin: 0 0 1rem; font-size: 1.1rem; color: #2c3e50;">联系我们</h4>
					<ul style="list-style: none; padding: 0; margin: 0; line-height: 1.8;">
						<li>📧 <a href="mailto:116566916@qq.com" style="color: #444; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#3498db'" onmouseout="this.style.color='#444'">116566916@qq.com</a></li>
						<li>🌐 <a href="https://moonglade.cc" target="_blank" rel="noopener" style="color: #444; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#3498db'" onmouseout="this.style.color='#444'">https://moonglade.cc</a></li>
					</ul>
				</div>

			</div>

			<div class="footer-copyright" style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #eee; text-align: center; color: #888; font-size: 0.9rem;">
				&copy; <?php echo date('Y'); ?> <a href="<?php echo esc_url(home_url('/')); ?>" style="color: #555; text-decoration: none;"><?php bloginfo('name'); ?></a>. 
				保留所有权利。
				<br>
				<span style="display: block; margin-top: 0.3rem; color: #aaa;">
					Powered by WordPress &amp; AuraWP Theme
				</span>
			</div>
		</div>
	</footer>

	<?php wp_footer(); ?>
</body>
</html>
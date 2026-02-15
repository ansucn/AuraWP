<?php
// template-parts/hero-search.php
$search_placeholder = is_search() ? '输入关键词继续搜索...' : '输入关键词搜索...';
$search_title = is_search() ? '搜索结果' : '发现优质资源';

if (is_search()) {
    $found_posts = $wp_query->found_posts;
    $search_desc = "找到 {$found_posts} 篇相关文章";
} else {
    $search_desc = '快速搜索你需要的软件、工具或教程';
}
?>

<div class="hero-search" style="text-align: center; padding: 60px 0 40px;">
    <h1 style="font-size: 2.4rem; margin: 0 0 12px; color: #2c3e50; font-weight: 700;">
        <?php echo esc_html($search_title); ?>
    </h1>
    <p style="font-size: 1.15rem; color: #555; margin: 0 0 24px; max-width: 650px; margin-left: auto; margin-right: auto;">
        <?php echo esc_html($search_desc); ?>
    </p>
    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" 
          class="hero-search-form" 
          style="display: flex; max-width: 650px; margin: 0 auto; height: 56px;">
        <input type="text" name="s" 
               placeholder="<?php echo esc_attr($search_placeholder); ?>" 
               value="<?php echo is_search() ? esc_attr(get_search_query()) : ''; ?>"
               style="flex: 1; padding: 0 28px; border: 2px solid #ddd; border-radius: 28px 0 0 28px; font-size: 1.1rem; outline: none; height: 100%; transition: border-color 0.2s;">
        <button type="submit" 
                style="background: #1e88e5; color: white; border: none; padding: 0 36px; border-radius: 0 28px 28px 0; font-size: 1.1rem; font-weight: 600; cursor: pointer; height: 100%; transition: background 0.2s;">
            搜索
        </button>
    </form>
</div>
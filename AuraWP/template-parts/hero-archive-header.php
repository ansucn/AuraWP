<?php
if (is_search()) {
    $title = '搜索结果："' . get_search_query() . '"';
    $description = "找到 {$wp_query->found_posts} 篇相关文章";
} elseif (is_category()) {
    $title = single_cat_title('', false);
    $description = category_description() ?: '该分类暂无描述';
} elseif (is_tag()) {
    $title = single_tag_title('', false);
    $description = tag_description() ?: '该标签暂无描述';
} elseif (is_author()) {
    $author = get_queried_object();
    $title = $author->display_name;
    $description = get_the_author_meta('description', $author->ID) ?: '该作者暂无介绍';
} else {
    $title = '发现优质资源';
    $description = '快速搜索你需要的软件、工具或教程';
}
?>

<div class="hero-archive" style="text-align: center; padding: 50px 0 30px; margin-bottom: 2rem; background: #fafafa; border-radius: 8px;">
    <h1 style="font-size: 2.2rem; margin: 0 0 12px; color: #2c3e50; font-weight: 700;">
        <?php echo esc_html($title); ?>
    </h1>
    <p style="font-size: 1.05rem; color: #666; margin: 0 0 20px; max-width: 600px; margin-left: auto; margin-right: auto;">
        <?php echo wp_kses_post(wpautop($description)); ?>
    </p>

    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" 
          style="display: flex; max-width: 550px; margin: 0 auto; height: 50px;">
        <input type="text" name="s" 
               placeholder="输入关键词继续搜索..." 
               value="<?php echo is_search() ? esc_attr(get_search_query()) : ''; ?>"
               style="flex: 1; padding: 0 24px; border: 2px solid #ddd; border-radius: 25px 0 0 25px; font-size: 1rem; outline: none; height: 100%;">
        <button type="submit" 
                style="background: #1e88e5; color: white; border: none; padding: 0 32px; border-radius: 0 25px 25px 0; font-size: 1rem; font-weight: 600; cursor: pointer; height: 100%;">
            搜索
        </button>
    </form>
</div>
<?php get_header(); ?>
<div class="container">
    <div class="page-container">
        <main class="main-content">
            <h2 class="archive-title">
                <?php if (is_category()): ?>
                    分类：<?php single_cat_title(); ?>
                <?php elseif (is_tag()): ?>
                    标签：<?php single_tag_title(); ?>
                <?php elseif (is_author()): ?>
                    作者：<?php the_author_meta('display_name', get_query_var('author')); ?>
                <?php elseif (is_day()): ?>
                    <?php echo get_the_date(); ?>
                <?php elseif (is_month()): ?>
                    <?php echo get_the_date('Y年m月'); ?>
                <?php elseif (is_year()): ?>
                    <?php echo get_the_date('Y年'); ?>
                <?php else: ?>
                    文章归档
                <?php endif; ?>
            </h2>
            <?php if (have_posts()): ?>
                <div class="posts-grid">
                    <?php while (have_posts()): the_post(); ?>
                        <?php get_template_part('template-parts/content', 'card'); ?>
                    <?php endwhile; ?>
                </div>
                <?php the_posts_pagination(['mid_size' => 2]); ?>
            <?php else: ?>
                <div class="no-posts">
                    <h2>该分类下暂无文章</h2>
                </div>
            <?php endif; ?>
        </main>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
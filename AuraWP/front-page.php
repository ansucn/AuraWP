<?php get_header(); ?>

<!-- 首页大搜索区域 -->
<div class="hero-search">
    <h2>快速查找您需要的资源</h2>
    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
        <input type="text" name="s" placeholder="输入关键词搜索文章、教程或资源..." value="<?php echo get_search_query(); ?>" autocomplete="off">
        <button type="submit">搜索</button>
    </form>
</div>

<main style="display:grid;grid-template-columns:2fr 1fr;gap:2rem;margin:1rem 0 2rem;">
    <div>
        <?php if (have_posts()): ?>
            <?php while (have_posts()): the_post(); ?>
                <article style="background:#fff;padding:1.5rem;margin-bottom:1.5rem;border-radius:10px;box-shadow:0 3px 10px rgba(0,0,0,0.06);">
                    <?php if (has_post_thumbnail()): ?>
                        <a href="<?php the_permalink(); ?>" style="display:block;margin-bottom:1rem;">
                            <?php the_post_thumbnail('large', ['style' => 'width:100%;height:auto;border-radius:8px;']); ?>
                        </a>
                    <?php endif; ?>
                    <h2 style="font-size:1.5rem;margin:0 0 0.5rem;">
                        <a href="<?php the_permalink(); ?>" style="color:#2c3e50;text-decoration:none;"><?php the_title(); ?></a>
                    </h2>
                    <div style="color:#7f8c8d;font-size:0.9rem;margin-bottom:1rem;display:flex;justify-content:space-between;align-items:center;">
                        <span><?php the_author(); ?> · <?php the_time('Y-m-d'); ?></span>
                        <span>👁️ <?php echo get_post_views(get_the_ID()); ?></span>
                    </div>
                    <div style="margin-bottom:1rem;color:#34495e;line-height:1.6;">
                        <?php echo wp_trim_words(get_the_excerpt(), 18); ?>
                    </div>
                    <a href="<?php the_permalink(); ?>" style="display:inline-block;background:#3498db;color:white;padding:0.5rem 1rem;border-radius:5px;text-decoration:none;font-size:0.95rem;">阅读更多</a>
                </article>
            <?php endwhile; ?>

            <div style="display:flex;justify-content:center;gap:0.5rem;margin-top:2rem;">
                <?php
                $big = 999999999;
                echo paginate_links(array(
                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format' => '?paged=%#%',
                    'current' => max(1, get_query_var('paged')),
                    'total' => $wp_query->max_num_pages,
                    'prev_text' => '« 上一页',
                    'next_text' => '下一页 »',
                    'type' => 'list',
                    'end_size' => 2,
                    'mid_size' => 2,
                ));
                ?>
            </div>
        <?php else: ?>
            <p style="text-align:center;color:#7f8c8d;">暂无文章</p>
        <?php endif; ?>
    </div>

    <?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>
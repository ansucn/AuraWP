<?php get_header(); ?>

<?php get_template_part('template-parts/hero-archive-header'); ?>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; padding: 20px 0 40px;">
    <main>
        <?php if (have_posts()) : ?>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.4rem;">
                <?php while (have_posts()) : the_post(); ?>
                    <article style="background: #fff; border-radius: 10px; box-shadow: 0 3px 12px rgba(0,0,0,0.08); overflow: hidden;">
                        <?php if (has_post_thumbnail()) : ?>
                            <div style="height: 150px; overflow: hidden;">
                                <?php the_post_thumbnail('medium', ['style' => 'width:100%; height:100%; object-fit: cover;']); ?>
                            </div>
                        <?php endif; ?>
                        <div style="padding: 1rem;">
                            <div style="display: flex; justify-content: space-between; font-size: 0.82rem; color: #888; margin-bottom: 0.5rem;">
                                <span><?php echo get_the_date('m-d'); ?></span>
                                <span>👁️ <?php echo function_exists('get_post_views') ? get_post_views(get_the_ID()) : '0'; ?></span>
                            </div>
                            <h3 style="font-size: 1.05rem; margin: 0 0 0.6rem; line-height: 1.4; color: #2c3e50;">
                                <a href="<?php the_permalink(); ?>" style="color: inherit; text-decoration: none;"><?php the_title(); ?></a>
                            </h3>
                            <div style="font-size: 0.92rem; color: #666; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                <?php echo wp_trim_words(get_the_excerpt(), 18); ?>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div style="margin-top: 2rem; text-align: center;">
                <?php the_posts_pagination([
                    'prev_text' => '&laquo; 上一页',
                    'next_text' => '下一页 &raquo;',
                ]); ?>
            </div>
        <?php else : ?>
            <p style="text-align: center; padding: 2rem; color: #888;">未找到匹配结果</p>
        <?php endif; ?>
    </main>

    <aside>
        <?php get_sidebar(); ?>
    </aside>
</div>

<?php get_footer(); // ← 使用您原来的 footer ?>
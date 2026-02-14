<?php get_header(); ?>

<!-- 大搜索栏 -->
<div class="hero-search" style="
    background: linear-gradient(135deg, #4a6fa6 0%, #2c3e50 100%);
    padding: 3rem 1rem;
    text-align: center;
    color: white;
    margin-bottom: 2rem;
">
    <h1 style="font-size: 2.2rem; margin: 0 0 1rem; font-weight: 600;">月光林地资源站</h1>
    <p style="font-size: 1.1rem; opacity: 0.9; max-width: 600px; margin: 0 auto 1.5rem;">
        专注 WordPress 主题、插件与数字资源分享
    </p>
    
    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" 
          style="max-width: 500px; margin: 0 auto;">
        <div style="display: flex;">
            <input type="text" name="s" 
                   placeholder="输入关键词搜索资源..." 
                   required
                   style="
                       flex: 1;
                       padding: 0.8rem 1.2rem;
                       border: none;
                       border-radius: 50px 0 0 50px;
                       font-size: 1rem;
                       outline: none;
                       color: #333;
                   ">
            <button type="submit" 
                    style="
                        background: #e74c3c;
                        color: white;
                        border: none;
                        padding: 0 1.5rem;
                        border-radius: 0 50px 50px 0;
                        cursor: pointer;
                        font-weight: bold;
                        transition: background 0.3s;
                    "
                    onmouseover="this.style.background='#c0392b'"
                    onmouseout="this.style.background='#e74c3c'">
                🔍 搜索
            </button>
        </div>
    </form>
</div>

<div class="container" style="padding: 0 0 2rem;">
    <div class="posts-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.8rem; margin-top: 1.5rem;">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="card" style="height: 100%;">
                <?php if (has_post_thumbnail()) : ?>
                    <a href="<?php the_permalink(); ?>" style="display: block; height: 180px; overflow: hidden;">
                        <?php the_post_thumbnail('medium', ['style' => 'width:100%; height:100%; object-fit: cover;']); ?>
                    </a>
                <?php endif; ?>

                <div style="padding: 1.2rem;">
                    <h2 style="font-size: 1.25rem; margin: 0 0 0.8rem; line-height: 1.4;">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>

                    <div style="font-size: 0.85rem; color: #777; margin-bottom: 0.8rem; line-height: 1.5;">
                        <?php echo wp_trim_words(get_the_excerpt(), 28, '...'); ?>
                    </div>

                    <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; margin-top: 0.8rem;">
                        <?php
                        $categories = get_the_category();
                        if ($categories) {
                            foreach (array_slice($categories, 0, 2) as $cat) {
                                echo '<span class="btn">' . esc_html($cat->name) . '</span>';
                            }
                        }
                        ?>
                    </div>

                    <div style="margin-top: 1rem; font-size: 0.85rem; color: #999; display: flex; justify-content: space-between; align-items: center;">
                        <span><?php echo get_the_date('m-d'); ?></span>
                        <span>👍 <?php echo get_post_meta(get_the_ID(), 'views', true) ?: '0'; ?></span>
                    </div>
                </div>
            </article>
        <?php endwhile; endif; ?>
    </div>

    <div style="margin-top: 2rem; text-align: center;">
        <?php
        the_posts_pagination([
            'mid_size' => 2,
            'prev_text' => '« 上一页',
            'next_text' => '下一页 »'
        ]);
        ?>
    </div>
</div>

<?php get_footer(); ?>
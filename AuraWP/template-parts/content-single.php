<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <div class="entry-meta">
            <span class="posted-on"><?php echo get_the_date('Y-m-d'); ?></span>
            <span class="byline"> by <?php the_author(); ?></span>
        </div>
        <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>

    <div class="entry-content">
        <?php the_content(); ?>
        
        <!-- 保留您的赞助代码 -->
        <?php if (get_option('sponsor_code')) : ?>
        <div class="sponsor-box">
            <?php echo wp_kses_post(get_option('sponsor_code')); ?>
        </div>
        <?php endif; ?>
        <!-- 保留您的赞助代码 -->
        
        <?php if (has_category()): ?>
        <div class="entry-categories">
            <?php the_category(' · '); ?>
        </div>
        <?php endif; ?>
        
        <?php if (has_tag()): ?>
        <div class="entry-tags">
            <?php the_tags('<span class="tag-label">标签: </span>', ' · ', ''); ?>
        </div>
        <?php endif; ?>
        
        <div class="entry-share">
            <span>分享：</span>
            <a href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>" target="_blank" class="share-btn twitter"><i class="fab fa-twitter"></i></a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="share-btn facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank" class="share-btn linkedin"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </div>

    <div class="related-posts">
        <h3 class="related-title">相关文章</h3>
        <?php
        $related = get_posts(array(
            'numberposts' => 3,
            'category__in' => wp_get_post_categories(get_the_ID()),
            'post__not_in' => array(get_the_ID())
        ));
        if ($related) :
        ?>
        <div class="related-list">
            <?php foreach ($related as $post) : setup_postdata($post); ?>
            <article class="related-item">
                <a href="<?php the_permalink(); ?>">
                    <h4 class="related-title"><?php the_title(); ?></h4>
                    <span class="related-date"><?php echo get_the_date('Y-m-d', $post->ID); ?></span>
                </a>
            </article>
            <?php endforeach; wp_reset_postdata(); ?>
        </div>
        <?php endif; ?>
    </div>
</article>
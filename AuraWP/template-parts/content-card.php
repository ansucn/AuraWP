<?php
/**
 * Template part for displaying a card of the post.
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('card'); ?>>
    <div class="card-body">
        <?php if (has_post_thumbnail()): ?>
        <div class="card-thumbnail">
            <?php the_post_thumbnail('medium'); ?>
        </div>
        <?php endif; ?>
        
        <div class="card-header">
            <div class="card-meta">
                <span class="card-category"><?php echo get_the_category_list(', '); ?></span>
                <span class="card-date"><?php echo get_the_date('Y-m-d'); ?></span>
            </div>
            <h2 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        </div>
        
        <div class="card-excerpt"><?php the_excerpt(); ?></div>
        
        <div class="card-footer">
            <a href="<?php the_permalink(); ?>" class="btn btn-primary">阅读全文</a>
            <?php
            // 安全检查阅读量函数（避免 Fatal Error）
            $views = 0;
            if (function_exists('get_post_views')) {
                $views = get_post_views(get_the_ID());
            }
            ?>
            <span class="card-views"><i class="fas fa-eye"></i> <?php echo esc_html($views); ?></span>
        </div>
    </div>
</article>
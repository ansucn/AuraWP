<article class="post-card">
    <?php if (has_post_thumbnail()): ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium_large'); ?>
            </a>
        </div>
    <?php endif; ?>
    <div class="post-body">
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div class="post-meta">
            <span><?php the_date(); ?></span>
            <span><?php the_author(); ?></span>
        </div>
        <p><?php echo wp_trim_words(get_the_excerpt(), 30); ?></p>
        <a href="<?php the_permalink(); ?>" class="read-more">阅读更多</a>
    </div>
</article>
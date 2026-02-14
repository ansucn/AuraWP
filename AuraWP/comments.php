<?php if (post_password_required()) return; ?>
<div id="comments" class="comments-area">
    <?php if (have_comments()): ?>
        <h3 class="comments-title">
            <?php printf(_n('1 条评论', '%1$s 条评论', get_comments_number(), 'aurawp'), number_format_i18n(get_comments_number())); ?>
        </h3>
        <ol class="comment-list">
            <?php wp_list_comments(['style' => 'ol', 'short_ping' => true]); ?>
        </ol>
        <?php the_comments_pagination(); ?>
    <?php endif; ?>

    <?php if (comments_open()): ?>
        <div class="comment-respond">
            <h3 class="comment-reply-title">发表评论</h3>
            <?php comment_form(); ?>
        </div>
    <?php endif; ?>
</div>
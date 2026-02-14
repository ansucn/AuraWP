<?php get_header(); ?>
<div class="container">
    <div class="page-container">
        <main class="main-content">
            <?php while (have_posts()): the_post(); ?>
                <article class="single-post">
                    <h1 class="post-title"><?php the_title(); ?></h1>
                    <div class="post-content">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        </main>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
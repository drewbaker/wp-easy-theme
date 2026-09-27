<?php
/*
 * Fallback template: used when router.php has no route for the current URL.
 * Renders the page like a plain content page rather than an error, so an
 * unrouted page is still usable. Add a route in router.php to give it a
 * proper template.
 */
?>
<main class="template-fallback page">
    <?php while (have_posts()) : the_post(); ?>
        <article class="page-content">
            <h1 class="page-title"><?php the_title(); ?></h1>
            <div class="page-body"><?php the_content(); ?></div>
        </article>
    <?php endwhile; ?>

    <?php if (current_user_can('edit_theme_options')) : ?>
        <!-- router.php has no route for this URL; rendered the fallback template (index.php). -->
    <?php endif; ?>
</main>

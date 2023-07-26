<?php
/*
 * This is a resuable page template
 */

 // $post is available automatically in all Page templates
 // get_route_name() returns the route name, which will be different depending on the route viewed.
?>

<section class="page-foobar">
    This is the <?php echo get_route_name(); ?> page.
    <br>
    Depending on the route viewed, <?php echo get_route_params(); ?> will return an array of strings that match the URL segments.
</section>

<style>
.page-foobar {
    background: blue;
}
</style>
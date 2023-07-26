<?php
/*
 * This is the page template shown at `/`
 */

 // $post is available automatically in all Page templates
 // get_route_name() returns the route name, in this case `index`
?>

<section class="page-home">
    This is the home page.
    
    <?php use_component('my-component', ['post' => $post, 'text' => 'Some text']); ?>

    <button id="button">Test button</button>
</section>

<style>
.page-home {
    background: honeydew;
}
</style>
  
<script>
  // For your convenience, $el is will automattically be the page (or component) as a jQuery object.
  $el.find('#button').click(()=>{
      console.log('The home page button was clicked on!')
  })
<script>
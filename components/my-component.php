<?php
// $props will be an array of values that were passed into the component
?>

<div class="my-component">
    This is an example component.

    <?php echo $props['text'] ?? 'No text provided'; ?>
</div>

<style>
.my-component {
    font-size: 20px;
}
</style>
  
<script>
  // For your convenience, $el is will automattically be the page (or component) as a jQuery object.
  $el.click(()=>{
      console.log('my-component was clicked on!')
  })
<script>
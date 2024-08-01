<?php
  $args = set_defaults($args, [
    'title' => 'Title default here',
  ]);
?>
<div class="work-block">
    Testing work block

    <h2 class="title">
        <?php echo $args['title']; ?>
    </h2>
</div>
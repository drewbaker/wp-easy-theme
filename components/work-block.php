<?php
// Set default args for the component
$args = set_defaults($args, [
    'title' => 'Title default here',
]);
?>

<div class="work-block">
    <h2 class="title">
        <?= $args['title']; ?>
    </h2>
</div>
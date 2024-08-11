<?php use_component('header'); ?>

<main class="template-home page">

    Home template example

    <!-- Example of a loop through all children of the current page -->
    <?php foreach (use_children() as $post) : ?>
        <h2 class="title">
            <?= get_the_title($post); ?>
        </h2>
    <?php endforeach; ?>

</main>

<?php use_component('footer'); ?>
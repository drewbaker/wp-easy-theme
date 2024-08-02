<?php use_header(); ?>

<main class="work">

    Work template

    <?php use_component('work-block', ['title' => 'test of title prop']); ?>

    <?php use_component('work-block', ['title' => '2nd work block']); ?>

    <?php use_component('work-block', ['title' => '3rd work block']); ?>

    <?php use_component('work-block'); ?>

</main>

<?php use_footer(); ?>
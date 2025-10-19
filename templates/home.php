<template>
    <main class="template-home main">

        Home template example

        <!-- Example of a loop through all children of the current page -->
        <?php foreach (use_children() as $post) : ?>
            <h2 class="title">
                <?= get_the_title($post); ?>
            </h2>
        <?php endforeach; ?>

    </main>
</template>

<style>
    .template-home {
        background-color: red;

        /* Media queries can be used like this */
        @media #{$lt-phone} {
            background-color: blue;
        }
    }
</style>
<template>
    <header class="header">
        <?php use_svg('logo', ['id' => 'test']); ?>
    </header>
</template>

<style>
    .header {
        background-color: green;

        /* Media queries can be used like this */
        @media #{$lt-phone} {
            background-color: yellow;
        }
    }
</style>
<?php
// Set default args for the component
$args = set_defaults($args, [
    'title' => 'Title default here',
]);
?>

<template>
    <div class="work-block">
        <h2 class="title">
            <?= $args['title']; ?>
        </h2>
    </div>
</template>

<style>
    @import 'media-queries';

    .work-block {
        background-color: red;

        .title {
            color: var(--color-black);
        }

        // Media queries can be used like this
        @media #{$lt-phone} {
            background-color: yellow;

            .title {
                color: var(--color-black);
            }
        }
    }
</style>

<script>
    // import {state} from "wp-easy/main";

    function init() {
        // Component is ready.
    }

    init()
</script>
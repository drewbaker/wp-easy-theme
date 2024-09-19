<template>
    <main class="template-work main">

        Work template example

        <?php var_dump(get_route_name()); ?>

        <?php use_component('work-block', ['title' => 'test of title argument']); ?>

        <?php use_component('work-block', ['title' => '2nd work block']); ?>

        <?php use_component('work-block', ['title' => '3rd work block']); ?>

        <?php use_component('work-block'); ?>

    </main>
</template>

<script>
    // import {state} from "main"

    function init() {
        // Work template loaded. You can even access the state object here because of the `import` statment above.
    }

    init()
</script>
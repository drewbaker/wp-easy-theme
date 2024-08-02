<!-- Would be so great if we could extract this template/script/style tags into separate files and then equeue them. -->
<template>
    <?php use_header(); ?>

    <main class="work-detail">

        <h2 class="title">Work detail example</h2>

    </main>

    <?php use_footer(); ?>
</template>

<script type="module">
    // So JS would go in here
</script>

<style lang="scss">
    .work-detail {
        background-color: red;

        .title {
            color: red;
        }
    }
</style>
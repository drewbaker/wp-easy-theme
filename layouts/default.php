<template>
<?php
	use_component( 'header' );

	// This is where the page template will be rendered
	use_outlet();

	use_component( 'footer' );
?>
</template>
<style>
    .header {
        /* styles go here */
    }
</style>

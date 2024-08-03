<?php
/*
 * Define the templates to use, based on the valid WordPress routes.
 * 
 * Syntax is similar to Express paths in Node
 * The key is the route name, and the value is an array of [path, template]
 * If no template set, the key is used as the template name.
 * 
 * SEE https://github.com/gpolguere/path-to-regexp-php
 */

wp_easy_router([
    'home'              => ['path' => '/'],
    'work'              => ['path' => '/work/'],
    'work-detail'       => ['path' => '/work/:spot/', 'template' => 'work'],
    'reel'              => ['path' => '/reel/'],
]);

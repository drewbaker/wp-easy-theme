<?php
/*
 * Define the templates to use, based on the valid WordPress routes.
 * 
 * Syntax is similar to Express paths in Node
 * The key is the route name, and the value is an array of [path, layout, template]
 * Values can also be strings, in which case the path is the string and the template name is the key.
 *
 * If no `template` set, the key is used as the template name.
 * If no `layout` set, then the `/layouts/default.php` file is used.
 * 
 * SEE https://github.com/drewbaker/wp-easy/blob/main/README.md
 */

$routes = [
    'home'              => '/',
    'work'              => '/work/',
    // Would use the /layouts/alternate.php layout, with the /templates/work.php page template
    'work-detail'       => ['path' => '/work/:spot/', 'layout' => 'alternate', 'template' => 'work'],
    'reel'              => '/reel/',
];

return $routes;

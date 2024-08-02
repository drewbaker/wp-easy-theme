<?php
// SEE https://github.com/makeitworkpress/wp-router
$router = new MakeitWorkPress\WP_Router\Router(
    [
        //'home'            => ['route' => '/'], // TODO Doesn't work, fix
        'work'              => ['route' => 'work/'],
        //'work-detail'       => ['route' => 'work/:spot/'], // TODO Need to upgrade router to allow this syntax. See https://github.com/gpolguere/path-to-regexp-php        
    ]
);

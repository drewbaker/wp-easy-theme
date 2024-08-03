<?php
// SEE https://github.com/makeitworkpress/wp-router

// TODO Need to upgrade router to allow this syntax. See https://github.com/gpolguere/path-to-regexp-php        
// TODO Reanme this class

$router = new MakeitWorkPress\WP_Router\Router(
    [
        //'home'            => ['route' => '/'], // TODO Doesn't work, fix
        'work'              => ['route' => 'work/'],
        'work-detail'       => ['route' => 'work/spot-detail/', 'template' => 'work'],
        'reel'              => ['route' => 'reel/'],
    ]
);

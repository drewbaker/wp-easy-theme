<?php
// SEE https://github.com/makeitworkpress/wp-router
$router = new MakeitWorkPress\WP_Router\Router(
    [
        //'home'    => ['route' => ''],
        'work-detail'    => ['route' => 'work/[a-zA-Z]'],
        'work'    => ['route' => 'work/'],
    ]
);

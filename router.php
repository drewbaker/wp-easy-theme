<?php
require_once get_template_directory() . '/libs/Router.php';

$router = new MakeitWorkPress\WP_Router\Router( 
    [
        'home'    => ['route' => ''],
        'work'    => ['route' => 'work/'],
    ]
);

?>
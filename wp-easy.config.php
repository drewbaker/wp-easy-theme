<?php
wp_easy_config([
    'styles' => [
        '/styles/global.scss',
        '/styles/fonts.css'
    ],
    'scripts' => [
        'id'    => 'jquery',
        'async' => true,
        'defer' => true,
        'src'   => 'https://code.jquery.com/jquery-3.7.0.slim.min.js'
    ]
])
?>
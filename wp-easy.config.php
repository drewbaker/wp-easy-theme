<?php
wp_easy_config([
    'jquery' => true,
    'styles' => [
        '/styles/global.scss',
        '/styles/fonts.css'
    ],
    'scripts' => [
        'async' => true,
        'defer' => true,
        'src'   => 'https://www.example.com/somefile.js'
    ]
])
?>
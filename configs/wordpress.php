<?php

return [
    'base_url' => env('WORDPRESS_REST_URL', 'http://example.com/wp-json'),
    'namespace' => env('WORDPRESS_REST_NAMESPACE', 'wp'),
    'version' => env('WORDPRESS_REST_VERSION', 'v2'),

    'classes' => [
        'params' => [
            'posts' => \Therour\WpApiClient\Params\PostParam::class,
            'page' => \Therour\WpApiClient\Params\PageParam::class,
            'categories' => \Therour\WpApiClient\Params\CategoryParam::class,
            'tags' => \Therour\WpApiClient\Params\TagParam::class,
            'media' => \Therour\WpApiClient\Params\MediaParam::class,
        ]
    ]
];

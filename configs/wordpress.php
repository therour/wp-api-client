<?php

return [
    'base_url' => env('WORDPRESS_REST_URL', 'http://example.com/wp-json'),
    'namespace' => env('WORDPRESS_REST_NAMESPACE', 'wp'),
    'version' => env('WORDPRESS_REST_VERSION', 'v2')
];

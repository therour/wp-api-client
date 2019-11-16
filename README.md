# Wordpress REST API Laravel Client

## Installation
```
composer require therour/wp-api-client
```

## Configuration
set your wordpress rest url in the `.env`
```
WORDPRESS_REST_URL=http://example.com/wp-json
```

## Usage
```php
use Therour\WpApi\Client\Models\WpPost;

$posts = WpPost::get();
```

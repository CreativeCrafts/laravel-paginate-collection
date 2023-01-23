# A handy package to paginate laravel collection

[![Latest Version on Packagist](https://img.shields.io/packagist/v/creativecrafts/laravel-paginate-collection.svg?style=flat-square)](https://packagist.org/packages/creativecrafts/laravel-paginate-collection)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/creativecrafts/laravel-paginate-collection/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/creativecrafts/laravel-paginate-collection/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/creativecrafts/laravel-paginate-collection/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/creativecrafts/laravel-paginate-collection/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/creativecrafts/laravel-paginate-collection.svg?style=flat-square)](https://packagist.org/packages/creativecrafts/laravel-paginate-collection)

A handy package to paginate a collection.

## Installation

You can install the package via composer:

```bash
composer require creativecrafts/laravel-paginate-collection
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-paginate-collection-config"
```

This is the contents of the published config file:

```php
return [
   /**
     * This is the default number of items that will be displayed per page.
     * default: 10
     */
    'items_per_page' => 10,

    /**
     * This is the default page name that will be used in the query string.
     * default: page
     */
    'page_name' => 'page',
];
```
## Usage

```php
You can use the Facade to paginate a collection
use CreativeCrafts\Paginate\Facades\Paginate 
or use the helper function
use CreativeCrafts\Paginate\Paginate;

$collection = collect([
   ['name' => 'Jack', 'age' => 40],
   ['name' => 'John', 'age' => 30],
   ['name' => 'Jane', 'age' => 25],
]);

$paginatedCollection = Paginate::collection($collection, 1);
// output:
// [
//    "current_page" => 1
//    "data" => [
//       0 => [
//          "name" => "Jack"
//          "age" => 40
//       ]
//    ],
//    "first_page_url" => "http://localhost:8000/?page=1"
//    "from" => 1
//    "last_page" => 3
//    "last_page_url" => "http://localhost:8000/?page=3"
//    "next_page_url" => "http://localhost:8000/?page=2"
//    "path" => "http://localhost:8000"
//    "per_page" => 1
//    "prev_page_url" => null
//    "to" => 1
//    "total" => 3
//    links => [
//       0 => [
//          "url" => "null",
//          "label" => "&laquo; Previous",
//          "active" => false
//       ],
//       1 => [
//          "url" => "http://localhost:8000/?page=1",
//          "label" => "1",
//          "active" => true
//       ],
//       2 => [
//          "url" => "http://localhost:8000/?page=2",
//          "label" => "2",
//          "active" => false
//       ],
//       3 => [
//          "url" => "http://localhost:8000/?page=3",
//          "label" => "3",
//          "active" => false
//       ],
//       4 => [
//          "url" => "http://localhost:8000/?page=2",
//          "label" => "Next &raquo;",
//          "active" => false
//       ]
//    ]
//]
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Godspower](https://github.com/rockblings)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

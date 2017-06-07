# Laravel Blade Directives

[![Latest Version on Packagist](https://img.shields.io/packagist/v/appstract/laravel-blade-directives.svg?style=flat-square)](https://packagist.org/packages/appstract/laravel-blade-directives)
[![Total Downloads](https://img.shields.io/packagist/dt/appstract/laravel-blade-directives.svg?style=flat-square)](https://packagist.org/packages/appstract/laravel-blade-directives)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/appstract/laravel-blade-directives/master.svg?style=flat-square)](https://travis-ci.org/appstract/laravel-blade-directives)

A collection of a few handy Blade directives.

## Installation

You can install the package via composer:

```bash
composer require appstract/laravel-blade-directives
```

### Provider

Then add the ServiceProvider to your `config/app.php` file:

```php
'providers' => [
    ...

    Appstract\BladeDirectives\BladeDirectivesServiceProvider::class

    ...
];
```

## Usage

```blade
@istrue($variable)
    // Only show when $variable isset and true
@endistrue
 
// or
@istrue($variable, 'This will be echoed')
```

```blade
@dump($var)
@dd($var)
```

## Testing

```bash
$ composer test
```

## Contributing

Contributions are welcome, [thanks to y'all](https://github.com/appstract/laravel-blade-directives/graphs/contributors) :)

## About Appstract

Appstract is a small team from The Netherlands. We create (open source) tools for webdevelopment and write about related subjects on [Medium](https://medium.com/appstract). You can [follow us on Twitter](https://twitter.com/teamappstract), [buy us a beer](https://www.paypal.me/teamappstract/10) or [support us on Patreon](https://www.patreon.com/appstract).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

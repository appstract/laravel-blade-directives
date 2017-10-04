# Laravel Blade Directives

[![Latest Version on Packagist](https://img.shields.io/packagist/v/appstract/laravel-blade-directives.svg?style=flat-square)](https://packagist.org/packages/appstract/laravel-blade-directives)
[![Total Downloads](https://img.shields.io/packagist/dt/appstract/laravel-blade-directives.svg?style=flat-square)](https://packagist.org/packages/appstract/laravel-blade-directives)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/appstract/laravel-blade-directives/master.svg?style=flat-square)](https://travis-ci.org/appstract/laravel-blade-directives)

A collection of nice Laravel Blade directives.
 
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

### @istrue

Only show when ```$variable``` isset and true.

```blade
@istrue($variable)
   This will be echoed
@endistrue
```

Or when you would like to quickly echo

```blade
@istrue($variable, 'This will be echoed')
```

### @isfalse

Same as ```@istrue``` but checks for isset and false.

```blade
@isfalse($variable)
   This will be echoed
@endisfalse
```

### @dump and @dd

```blade
@dump($var)

@dd($var)
```

### @mix

Create a HTML element to your Laravel-Mix css or js.
```blade
@mix('/css/app.css')
@mix('/css/app.js')
```
Output:

```blade
<link rel="stylesheet" href="{{ mix('/css/app.css') }}">
<script src="{{ mix('/css/app.js') }}"></script>
```

### @style

Create a ```<style>``` element or ```<link>``` element with a css path.

```blade
@style
    body { background: black }
@endstyle    


@style('/css/app.css')
```

### @script

Create a ```<script>``` element with or without a js path.

```blade
@script
    alert('hello world')
@endscript


@script('/js/app.js')
```

### @inline

Load the contents of a css or js file inline in your view.

```blade
@inline('/js/manifest.js')
```


### @pushonce

Same as `@push` but will include content one time only. Useful for repeatable blocks.

First parameter must follow the syntax `stack-name:group-name`.

```blade
@pushonce('js:foobar')
    <script src="{{ asset('/js/foobar.js') }}"></script>
@endpushonce
```

Include pushes with standard `@stack` directive:

```blade
@stack('js')
```

### @routeis

Checks if the current route name is equal to the given parameter.

```blade
@routeis('webshop.checkout')
    Do something only on the checkout
@endrouteis
```

### @routeisnot

Checks if the current route name is not equal to the given parameter.

```blade
@routeisnot('webshop.checkout')
    Do something only if this is not the checkout
@endrouteisnot
```

### @instanceof

Checks if the first parameter is an instance of the second parameter.

```blade
@instanceof($user, App\User)
    User is an instance of App\User
@endinstanceof
```

### @typeof

Checks if the parameter is of a certain type.

```blade
@typeof($text, 'string')
    Text is a string
@endtypeof
```

### @fa

Quickly output a Font Awesome icon.

```blade
@fa('address-book')
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

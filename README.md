# `@bind` Attribute for Laravel Blade

<p>
<a href="https://github.com/pboivin/laravel-blade-bind-attributes/actions"><img src="https://github.com/pboivin/laravel-blade-bind-attributes/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/pboivin/laravel-blade-bind-attributes"><img src="https://img.shields.io/packagist/v/pboivin/laravel-blade-bind-attributes" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/pboivin/laravel-blade-bind-attributes"><img src="https://img.shields.io/packagist/l/pboivin/laravel-blade-bind-attributes" alt="License"></a>
</p>

⚠ EXPERIMENTAL ⚠

This package adds support for a `@bind` attribute in Blade component tags. This new attribute allows you to extract all keys from a given array as component props:

```blade
@php
    $header = [
        'title' => 'Lorem ipsum',
        'secondaryTitle' => 'Dolor sit amet',
    ];
@endphp

<x-header @bind="$header" class="my-header" />
```

This is equivalent to:

```blade
<x-header
    :title="$header['title']"
    :secondary-title="$header['secondaryTitle']"
    class="my-header"
/>
```

## Requirements

- PHP >= 8.1
- Laravel 9.x

## Installation

```
composer require pboivin/laravel-blade-bind-attributes

php artisan view:clear
```

## Caveats

With class-based components, make sure to include a `@props()` directive in your template, even when you are defining the props on the component class:

`app/View/Components/Header.php :`

```php
class Header extends Component
{
    public function __construct(
        public $title = 'Hello',
        public $secondaryTitle = 'World'
    ){}

    public function render()
    {
        return view('components.header');
    }
}
```

`resources/views/components/header.blade.php :`

```blade
@props([
    'title',
    'secondaryTitle',
])

<div {{ $attributes }}>
    <h1>{{ $title }}</h1>
    <h2>{{ $secondaryTitle }}</h2>
    {{-- ... --}}
</div>
```

## Development

#### Test suite ([phpunit](https://phpunit.de/))

```
composer run test
```

#### Code formatting ([pint](https://laravel.com/docs/9.x/pint))

```
composer run format
```

## License

This is open-sourced software licensed under the [MIT license](LICENSE.md).

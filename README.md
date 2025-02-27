![](https://banners.beyondco.de/Laravel%20MySQL%20USE%20INDEX%20Model%20Scope.png?theme=light&packageManager=composer+require&packageName=vpominchuk%2Flaravel-mysql-use-index-scope&pattern=texture&style=style_1&description=Allowing+for+use+MySQL+USE+INDEX+and+FORCE+INDEX+statements&md=1&showWatermark=0&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vpominchuk/laravel-mysql-use-index-scope.svg?style=flat-square)](https://packagist.org/packages/vpominchuk/laravel-mysql-use-index-scope)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Total Downloads](https://img.shields.io/packagist/dt/vpominchuk/laravel-mysql-use-index-scope.svg?style=flat-square)](https://packagist.org/packages/vpominchuk/laravel-mysql-use-index-scope)

# Laravel MySQL Use Index Scope
A super simple package allowing for use MySQL `USE INDEX` and `FORCE INDEX` statements.

## Requirements
- PHP `^7.4 | ^8.0`
- Laravel 6, 7, 8, 9, 10, 11, and 12

## Installation

`composer require vpominchuk/laravel-mysql-use-index-scope`

## Usage
Simply reference the required trait in your model:

### Model:
```php
    use VPominchuk\ModelUseIndex;
    
    class MyModel extends Model
    {
        use ModelUseIndex;
    }
```

### Anywhere in the code:
```php
    $builder = MyModel::where('name', $name)->where('age', $age)->
        useIndex($indexName)->...
```

### Database table structure:
You need to create a named index with required name. For example:

Laravel Migration:
```php
    $table->index(['name', 'age'], 'user_age_index');
```
## Available methods
#### `useIndex($indexName)`
Tells MySQL to use an index if it possible.

#### `forceIndex($indexName)`
Force MySQL to use an index if it possible.

#### `ignoreIndex($indexName)`
Ask MySQL to ignore an index if it possible.

## Security

If you discover any security related issues, please use the issue tracker.

## Credits

- [Vasyl Pominchuk](https://github.com/vpominchuk)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.


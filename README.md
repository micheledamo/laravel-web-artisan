![Laravel Web Artisan](images/laravel-web-artisan-logo.svg?raw=true "Laravel Web Artisan")

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

This package allows you to execute Artisan commands in a simple way using the browser window. If you don't have SSH access to the hosting platform where your Laravel site is hosted, this solution allows you to run commands like "php artisan migrate" in a virtual shell on the browser.

> This package requires Laravel 5.8 or higher.

![Preview](images/laravel-web-artisan-preview.jpg?raw=true "Preview")

## Installation

Require this package with Composer on your Laravel project.

``` bash
$ composer require micheledamo/laravel-web-artisan
```
Laravel uses Package Auto-Discovery, so you don't need to manually add the ServiceProvider.

The Web Artisan window will be enabled when WEBARTISAN_ENABLED is true, on your .env project file.     
The following line must be added in the .env file of your Laravel project to enable the Web Artisan window, otherwise it is disabled by default.

``` bash
WEBARTISAN_ENABLED=true
```

## Usage
Simply, go to any page of your site and you will see the Web Artisan window appear at the bottom of the page.  
Run any type of [Artisan](https://laravel.com/docs/7.x/artisan) command, even custom ones, as in a terminal shell: **et voilà**.

> ![Usage example](images/usage.gif?raw=true "Usage example")

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Michele Damo][link-author]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/micheledamo/laravel-web-artisan.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/micheledamo/laravel-web-artisan.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/micheledamo/laravel-web-artisan.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/micheledamo/laravel-web-artisan
[link-code-quality]: https://scrutinizer-ci.com/g/micheledamo/laravel-web-artisan
[link-downloads]: https://packagist.org/packages/micheledamo/laravel-web-artisan
[link-author]: https://github.com/micheledamo
[link-contributors]: ../../contributors

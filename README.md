# instagram-sdk

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

A modern Instagram SDK for PHP 5.4+.

## Install

Via Composer

``` bash
$ composer require hassankhan/instagram-sdk
```

## Usage

To make requests to the Instagram API, you first need an access token. First, create an instance of `Instagram`.

``` php
$instagram = new \Instagram\Instagram($clientId, $clientSecret);
$instagram->user()->search('skrawg');
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email contact@hassankhan.me instead of using the issue tracker.

## Credits

- [Hassan Khan][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/hassankhan/instagram-sdk.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/hassankhan/instagram-sdk/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/hassankhan/instagram-sdk.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/hassankhan/instagram-sdk.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/hassankhan/instagram-sdk.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/hassankhan/instagram-sdk
[link-travis]: https://travis-ci.org/hassankhan/instagram-sdk
[link-scrutinizer]: https://scrutinizer-ci.com/g/hassankhan/instagram-sdk/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/hassankhan/instagram-sdk
[link-downloads]: https://packagist.org/packages/hassankhan/instagram-sdk
[link-author]: https://github.com/hassankhan
[link-contributors]: ../../contributors

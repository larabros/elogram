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

### Retrieving an access token

To make requests to the Instagram API, you need an access token. To do this, first instantiate `Instagram` - the `$clientId`, `$clientSecret` and `$redirectUrl` **must** be the same as what you see in the [Instagram Developer Panel](https://www.instagram.com/developer/clients/manage/):

``` php
$instagram = new \Instagram\Instagram($clientId, $clientSecret, null, $redirectUrl);
```

Then retrieve the login helper object and check whether to redirect or retrieve an access token:

```php
$helper    = $instagram->getLoginHelper();

// If we don't have an authorization code then get one
if (!isset($_GET['code'])) {
    header('Location: ' . $helper->getLoginUrl());
    exit;
} else {
    $token = $helper->getAccessToken($_GET['code']);
    echo json_encode($token);
}
```

After logging in, you should be redirected back to the `$redirectUri` and you should be able to see your access token. Copy the whole JSON string and save for future use.

### Making requests with an access token

Once you have retrieved an access token, use it to instantiate:

``` php
$instagram = new \Instagram\Instagram($clientId, $clientSecret, $accessToken, $redirectUrl);

header('Content-Type: application/json');
$response = $instagram->media()->search(51.503349, -0.252271);
echo json_encode($response->get());
```

### Paginating requests

You can also paginate requests if the need arises. The `Response` object returned contains the data from the multiple requests combined, including the first one. 

``` php
$instagram = new \Instagram\Instagram($clientId, $clientSecret, $accessToken, $redirectUrl);

header('Content-Type: application/json');
$response = $instagram->media()->search(51.503349, -0.252271);
$response = $instagram->paginate($response, 5);
echo json_encode($response->get());
```

You can also pass a `$limit` parameter to `Instagram::paginate()`, which sets the number of pages to request.

## Methods

Check [the API documentation](http://hassankhan.me/instagram-sdk/docs/) for detailed descriptions on available methods:

- [User](http://hassankhan.me/instagram-sdk/docs/class-Instagram.Entities.User.html)
- [Media](http://hassankhan.me/instagram-sdk/docs/class-Instagram.Entities.Media.html)

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

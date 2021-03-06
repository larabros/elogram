# Changelog

All notable changes to `elogram` will be documented in this file.

Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

## NEXT - YYYY-MM-DD

### Added
- Nothing

### Deprecated
- Nothing

### Fixed
- Nothing

### Removed
- Nothing

### Security
- Nothing

## 1.2.2 - 2016-05-05

### Fixed
- Setting access tokens via `Client::setAccessToken()` now works as expected.

## 1.2.1 - 2016-03-18

### Fixed
- Access token is not JSON-serialized when using `Client::setAccessToken()`.

## 1.2.0 - 2016-03-18

### Fixed
- Internal classes can now properly be overridden.

### Removed
- Removed `$registerProviders` from `Builder::__construct()`'s method signature.

## 1.1.8 - 2016-03-16

### Added
- Created `Http\UrlParserTrait` and moved methods `SecureRequestMiddleware::getPath()` and `SecureRequestMiddleware::getParams()` to it.

### Fixed
- Changed namespace `Entities` to `Repositories`.

## 1.1.7 - 2016-03-15

### Fixed
- A bug in the instantiation of `RedirectLoginHelper`.

## 1.1.6 - 2016-03-15

### Fixed
- Renamed `LeagueProvider` to `LeagueAdapter`.

## 1.1.5 - 2016-03-15

### Fixed
- Changed concrete dependency on `League\OAuth2\Provider\Instagram` by adding a new interface `OAuth2\Providers\AdapterInterface`.

## 1.1.4 - 2016-03-15

### Fixed
- Pagination now works correctly when secure requests are enabled.

## 1.1.3 - 2016-03-15

### Fixed
- `Response::merge()` would return incorrect results when using older versions of the `illuminate/support` package.

## 1.1.2 - 2016-03-10

### Added
- Documentation for lots of things

### Fixed
- `Response::getRaw()` now accepts a `$key` parameter

## 1.1.1 - 2016-03-10

### Fixed
- Incorrect handling after authorization fixed.

## 1.1.0 - 2016-03-09

### Fixed
- Package moved to new namespace `Larabros` and renamed to Elogram
- Renamed `Instagram` to `Client`

### Removed
- Removed `Instagram::getConfig()`.

## 1.0.4 - 2016-03-08

### Added
- Added more rules to `.gitattributes`
- Extracted `AbstractMiddleware::create()` into `CreateMiddlewareTrait`

### Fixed
- Package now works from PHP 5.5.9 and above
- Project now fully adheres to the PSR-2 standard

## 1.0.3 - 2016-03-07

### Fixed
- Broken middleware in PHP 5.

## 1.0.2 - 2016-03-07

### Added
- More exceptions as per the API.

### Fixed
- The correct exceptions were not being thrown due to the API returning data inconsistently.

### Removed
- Removed `Instagram::getLoginHelper()` in favour of `getLoginUrl()` and `getAccessToken()`.

## 1.0.1 - 2016-03-07

### Added
- An `OAuthException` is now thrown if the required parameters are not provided to a request.

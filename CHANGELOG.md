# Changelog

All notable changes to `elogram` will be documented in this file

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

## 1.1.4 - 2016-03-15

### Fixed
- Pagination now works correctly when secure requests are enabled.

## 1.1.2 - YYYY-MM-DD

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

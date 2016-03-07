# Changelog

All notable changes to `instagram-sdk` will be documented in this file

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

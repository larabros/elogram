TODO

- Add more useful domain-specific exceptions

## Problems
- No tests for failure cases

## Features
- Generators

## Refactors
- Change `Response::getRaw()`
- Create new `RequestBody` class
- Rename `Entities` to `Repositories`
- Allow `Config` implementation to be specified
- Add `Instagram::setAccessToken()` and `setSecureRequests()`
- Add `fixtures` option to `Config`
- Throw exception if session hasn't been initialised
- Make `AuthMiddleware::create()` use `Config`

## Tests
-

## Documentation
- Pagination (all, limited, incremental)
- Overriding other core classes
- `Instagram::request()`
- `Instagram::setAccessToken()`
- Signed requests
- Mention any exceptions thrown

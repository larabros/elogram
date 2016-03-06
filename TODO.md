TODO

- Add more useful domain-specific exceptions

## Problems
- No tests for failure cases

## Features
- Signed requests
- Generators

## Refactors
- Rename `Entities` to `Repositories`
- Make `Response::get()` return a `Collection`
    - Check if content has either `id` or `name`
- Add `Response::merge()`
    - Do same check as above and merge as appropriate
- Allow `Config` implementation to be specified
- Add `Instagram::setAccessToken()` and `setSecureRequests()`

## Tests
- Create separate suite for Entities

TODO

- Add more useful domain-specific exceptions

## Problems
- No tests for failure cases
- User::find('000000')

## Features
- Generators

## Refactors
- Change `Response::getRaw()` to accept a `$key` parameter
- Create new `RequestBody` class
- Rename `Entities` to `Repositories`
- Allow `Config` implementation to be specified
- Add `fixtures` option to `Config`

## Tests
-

## Documentation
- Pagination (all, limited, incremental)
- Overriding other core classes
- `Instagram::request()`
- `Instagram::setAccessToken()`
- Signed requests
- Mention any exceptions thrown

- Create issue/PR templates
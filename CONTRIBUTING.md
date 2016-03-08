# Contributing

Contributions are **welcome** and will be fully **credited**.

We accept contributions via Pull Requests on [Github](https://github.com/hassankhan/elogram).

## Documentation

Documentation for this project is available at http://elogram.readthedocs.org.

Documentation for the API is available at http://elogram.readthedocs.org/en/latest/_static/api.

## Guidelines

- **[PSR-2 Coding Standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)** - The easiest way to apply the conventions is to install [PHP Code Sniffer](http://pear.php.net/package/PHP_CodeSniffer).

- **PHP 5.5** - Elogram has a minimum PHP version requirement of PHP 5.5. Pull requests must not require a PHP version greater than PHP 5.5 unless the feature is only utilized conditionally.

- **Add tests!** - All pull requests must include unit tests to ensure the change works as expected and to prevent regressions.

- **Document any change in behaviour** - Make sure the `README.md` and any other relevant documentation are kept up-to-date.

- **Consider our release cycle** - We try to follow [SemVer v2.0.0](http://semver.org/). Randomly breaking public APIs is not an option.

- **Create feature branches** - Don't ask us to pull from your master branch.

- **One pull request per feature** - If you want to do more than one thing, send multiple pull requests.

- **Send coherent history** - Make sure each individual commit in your pull request is meaningful. If you had to make multiple intermediate commits while developing, please [squash them](http://www.git-scm.com/book/en/v2/Git-Tools-Rewriting-History#Changing-Multiple-Commit-Messages) before submitting.


## Running tests

In order to contribute, you'll need to checkout the source from GitHub and install dependencies using Composer:

``` bash
$ git clone https://github.com/hassankhan/elogram.git
$ cd elogram && composer install --dev
$ php vendor/bin/phpunit
```

## Reporting a security vulnerability

We want to ensure that Elogram is secure for everyone. If you've discovered
a security vulnerability, we appreciate your help in disclosing it to
us in a `responsible manner <http://en.wikipedia.org/wiki/Responsible_disclosure>`_.

Publicly disclosing a vulnerability can put the entire community at risk. If
you've discovered a security concern, please email us at
contact@hassankhan.me. We'll work with you to make sure that we understand the
scope of the issue, and that we fully address your concern. We consider
correspondence sent to this email address our highest priority, and work to
address any issues that arise as quickly as possible.

After a security vulnerability has been corrected, a security hotfix release will
be deployed as soon as possible.


**Happy coding**!

# Contributing

Contributions are **welcome** and will be fully **credited**.

We accept contributions via Pull Requests on [Github](https://github.com/larabros/elogram).

## Documentation

Documentation for this project is available at the [ReadTheDocs page](http://elogram.readthedocs.org).

The API reference documentation is available [here](http://elogram.readthedocs.org/en/stable/Larabros/Elogram/index.html).

## Guidelines

- **PSR-2 Coding Standard:** The easiest way to apply [the code standard]((https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)) is to install [PHP Code Sniffer](http://pear.php.net/package/PHP_CodeSniffer).

- **PHP 5.5.9:** Elogram has a minimum PHP version requirement of PHP 5.5.9. Pull requests must not require a PHP version greater than PHP 5.5.9 unless the feature is only utilized conditionally.

- **Add tests!:** All pull requests must include unit tests to ensure the change works as expected and to prevent regressions.

- **Documentation format:** All documentation **except** this file, `CHANGELOG.md`, `LICENSE.md` and `README.md` are in [reStructuredText](http://docutils.sourceforge.net/docs/user/rst/quickstart.html) - this includes any code docblocks. Using reST allows us to generate a better experience for users browsing the documentation.

- **Document any change in behaviour:** Make sure the `README.md` and any other relevant documentation are kept up-to-date.

- **Consider our release cycle:** We try to follow [SemVer v2](http://semver.org/). Randomly breaking public APIs is not an option.

- **Use Git Flow:** Don't ask us to pull from your master branch. Set up [Git Flow](http://nvie.com/posts/a-successful-git-branching-model/) and create a new feature branch from `develop`.

- **One pull request per feature:** If you want to do more than one thing, send multiple pull requests.

- **Send coherent history:** Make sure each individual commit in your pull request is meaningful. If you had to make multiple intermediate commits while developing, please [squash them](http://www.git-scm.com/book/en/v2/Git-Tools-Rewriting-History#Changing-Multiple-Commit-Messages) before submitting.


## Running tests

In order to contribute, you'll need to checkout the source from GitHub and install dependencies using Composer:

``` bash
$ git clone https://github.com/larabros/elogram.git
$ cd elogram && composer install
$ php vendor/bin/phpunit
```

## Reporting a security vulnerability

We want to ensure that Elogram is secure for everyone. If you've discovered a security vulnerability, we appreciate your help in disclosing it to us in a [responsible manner](http://en.wikipedia.org/wiki/Responsible_disclosure).

Publicly disclosing a vulnerability can put the entire community at risk. If you've discovered a security concern, please email us at contact@hassankhan.me. We'll work with you to make sure that we understand the scope of the issue, and that we fully address your concern. We consider correspondence sent to this email address our highest priority, and work to address any issues that arise as quickly as possible.

After a security vulnerability has been corrected, a security hotfix release will be deployed as soon as possible.


**Happy coding**!

==========
Developers
==========


Contributing
============

Contributions are **welcome** and will be fully **credited**.

We accept contributions via Pull Requests on `Github`_.

Documentation
-------------

Documentation for this project is available at
http://elogram.readthedocs.org.

The API reference documentation is available at
http://elogram.rtfd.org/en/stable/_static/api.

Guidelines
----------

-  **PSR-2 Coding Standard** - The easiest way to apply the `Standard`_ is to
   install `PHP Code Sniffer`_.

-  **PHP 5.5** - Elogram has a minimum PHP version requirement of
   PHP 5.5. Pull requests must not require a PHP version greater than
   PHP 5.5 unless the feature is only utilized conditionally.

-  **Add tests!** - All pull requests must include unit tests to ensure
   the change works as expected and to prevent regressions.

-  **Document any change in behaviour** - Make sure the ``README.md``
   and any other relevant documentation are kept up-to-date.

-  **Consider our release cycle** - We try to follow `SemVer v2`_.
   Randomly breaking public APIs is not an option.

-  **Create feature branches** - Don’t ask us to pull from your master
   branch.

-  **One pull request per feature** - If you want to do more than one
   thing, send multiple pull requests.

-  **Send coherent history** - Make sure each individual commit in your
   pull request is meaningful. If you had to make multiple intermediate
   commits while developing, please `squash them`_ before submitting.

Running tests
-------------

In order to contribute, you’ll need to checkout the source from GitHub
and install dependencies using Composer:

.. code:: bash

    $ git clone https://github.com/larabros/elogram.git
    $ cd elogram && composer install --dev
    $ php vendor/bin/phpunit

Reporting a security vulnerability
----------------------------------

We want to ensure that Elogram is secure for everyone. If you’ve
discovered a security vulnerability, we appreciate your help in disclosing it to
us in a `responsible manner`_.

Publicly disclosing a vulnerability can put the entire community at risk. If
you’ve discovered a security concern, please email us at contact@hassankhan.me.
We’ll work with you to make sure that we understand the scope of the issue, and
that we fully address your concern. We consider correspondence sent to this
email address our highest priority, and work to address any issues that arise as
quickly as possible.

After a security vulnerability has been corrected, a security hotfix release
will be deployed as soon as possible.

**Happy coding**!

.. _Github: https://github.com/larabros/elogram
.. _Standard: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
.. _PHP Code Sniffer: http://pear.php.net/package/PHP_CodeSniffer
.. _SemVer v2: http://semver.org/
.. _squash them: http://www.git-scm.com/book/en/v2/Git-Tools-Rewriting-History#Changing-Multiple-Commit-Messages
.. _responsible manner: http://en.wikipedia.org/wiki/Responsible_disclosure


Extending core components
=========================

`NativeSessionStore`
--------------------

When using Elogram in a framework, you may want to replace the built-in
session storage handler with a custom class that interacts with the framework.
This class **must** implement the `DataStoreInterface`. An example is provided
below:

.. code-block:: php

    use Elogram\Http\Sessions\DataStoreInterface;

    class FrameworkSessionStorageHandler implements DataStorageInterface
    {
        public function get($key)
        {
            // @TODO: Implement
        }

        public function set($key, $value)
        {
            // @TODO: Implement
        }
    }

After creating this class, the `Instagram` class must be instantiated with an array of options:

.. code-block:: php

    use Larabros\Elogram\Client;

    $options = ['session_store' => FrameworkSessionStorageHandler::class];
    $client  = new Client($clientId, $clientSecret, $accessToken, $redirectUrl, $options);


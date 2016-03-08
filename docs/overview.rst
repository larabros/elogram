========
Overview
========

Requirements
============

#. PHP 5.5.0
#. An Instagram client ID and secret

.. note::

    You can create an Instagram app at https://www.instagram.com/developer/clients/register/

.. _installation:

Installation
============

The recommended way to install Elogram is with
`Composer <http://getcomposer.org>`_. Composer is a dependency management tool
for PHP that allows you to declare the dependencies your project needs and
installs them into your project.

.. code-block:: bash

    # Install Composer
    curl -sS https://getcomposer.org/installer | php

You can add Elogram as a dependency using the ``composer.phar`` CLI:

.. code-block:: bash

    php composer.phar require hassankhan/instagram-sdk:~1.0

Alternatively, you can specify it as a dependency in your project's
existing ``composer.json`` file:

.. code-block:: js

    {
      "require": {
         "hassankhan/instagram-sdk": "~1.0"
      }
   }

After installing, you need to require Composer's autoloader:

.. code-block:: php

    require 'vendor/autoload.php';

You can find out more on how to install Composer, configure autoloading, and
other best-practices for defining dependencies at `getcomposer.org <http://getcomposer.org>`_.

License
=======

Licensed using the `MIT license <http://opensource.org/licenses/MIT>`_.

    Copyright (c) 2016 Hassan Khan <contact@hassankhan.me>

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in
    all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
    THE SOFTWARE.


Contributing
============

Contributions are **welcome** and will be fully **credited**.

We accept contributions via Pull Requests on `Github`_.

Documentation
-------------

Documentation for this project is available at
http://instagram-sdk.readthedocs.org.

The API reference is available at
http://instagram-sdk.readthedocs.org/en/latest/_static/api.

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

    $ git clone https://github.com/hassankhan/instagram-sdk.git
    $ cd instagram-sdk && composer install --dev
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

.. _Github: https://github.com/hassankhan/instagram-sdk
.. _Standard: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
.. _PHP Code Sniffer: http://pear.php.net/package/PHP_CodeSniffer
.. _SemVer v2: http://semver.org/
.. _squash them: http://www.git-scm.com/book/en/v2/Git-Tools-Rewriting-History#Changing-Multiple-Commit-Messages
.. _responsible manner: http://en.wikipedia.org/wiki/Responsible_disclosure

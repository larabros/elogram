==========
Developers
==========

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

    $options = ['session_store' => FrameworkSessionStorageHandler::class];
    $client = new Elogram\Instagram($clientId, $clientSecret, null, $redirectUrl, $options);


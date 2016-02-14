Configuration Reference
=======================

Full configuration
------------------

.. code-block:: yaml

    wouterj_eloquent:
        connections:

            # Prototype
            name:
                database:  ~     # the only required option
                driver:    mysql
                host:      localhost
                username:  root
                password:  ''
                charset:   utf8
                collation: utf8_unicode_ci
                prefix:    ''
        default_connection: default
        eloquent: false
        aliases: false

Connections
-----------

The ORM accepts multiple connections with a different name. A lot of settings
have defaults, the only required setting is the ``database`` setting.

If you want to configure only one connection, you can pass the connection
setting directly to the root configuration:

.. code-block:: yaml

    wouterj_eloquent:
        driver: sqlite
        host: local
        database: foo.db
        username: user
        password: pass
        prefix: symfo_

This will create a connection called ``default``. If the defaults fits your
needs, the minimal configuration to get started is:

.. code-block:: yaml

    wouterj_eloquent:
        database: the_database_name

Drivers
~~~~~~~

The Eloquent ORM supports four database drivers:

* mysql
* postgres
* sqlserver
* sqlite

Default Connection
------------------

If your default connection is not ``default``, you can specify its name using
this option.

Eloquent
--------

By default, the Eloquent ORM is disabled. This means you can use the
QueryBuilder, but not the Eloquent models. To activate the Eloquent ORM, you
have to set the ``eloquent`` option to ``true``:

.. code-block:: yaml

    wouterj_eloquent:
        # ...
        eloquent: true

Aliases
-------

The EloquentBundle provides two facades: ``DB`` and ``Schema``. You can also
alias these facades, which means that you can always use ``DB`` and ``Schema``
directly, without including a ``use`` statement.

You can activate both facades to be aliases by setting ``aliases`` to
``true``:

.. code-block:: yaml

    wouterj_eloquent:
        # ...
        aliases: true

You can also specify either ``DB`` or ``Schema`` to be aliased:

.. code-block:: yaml

    wouterj_eloquent:
        # ...
        aliases:
            db: true

Other Configuration Formats
---------------------------

XML
~~~

.. code-block:: xml

    <?xml version="1.0" ?>
    <container xmlns="http://symfony.com/schema/dic/services">

        <config xmlns="http://wouterj.nl/schema/dic/eloquent"
            driver="mysql"
            host="localhost"
            database="db_name"
            username="root"
            password="pass"
            prefix="symfo_"
        >
            <eloquent /> <!-- enables eloquent -->
            <aliases />  <!-- enables aliasing -->
            <!-- enable only db: <aliases db="true" /> -->
        </config>
    </container>

PHP
~~~

.. code-block:: php

    $container->loadFromExtension('wouterj_eloquent', [
        'driver'   => 'mysql',
        'host'     => 'localhost',
        'database' => 'db_name',
        'username' => 'root',
        'password' => 'pass',
        'prefix'   => 'symfo_',
        'eloquent' => true,  // enables eloquent
        'aliases'  => true,   // enables aliases
        // enable only db: 'aliases' => ['db' => true]
    ]);

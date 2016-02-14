<?php

$container->loadFromExtension('wouterj_eloquent', [
    'connections' => [
        'default' => [
            'database' => 'database',
        ],
        'foo' => [
            'driver' => 'sqlite',
            'host' => 'local',
            'database' => 'foo.db',
            'username' => 'user',
            'password' => 'pass',
            'prefix' => 'symfo_',
        ],
    ],
    'default_connection' => 'foo',
]);

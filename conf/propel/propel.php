<?php

return [
    'propel' => [
        'database' => [
            'connections' => [
                'bookstore' => [
                    'adapter'    => 'mysql',
                    'classname'  => 'Propel\Runtime\Connection\ConnectionWrapper',
                    'dsn'        => 'mysql:host=localhost;dbname=orm_test',
                    'user'       => 'root',
                    'password'   => '',
                    'attributes' => []
                ]
            ]
        ],
        'runtime' => [
            'defaultConnection' => 'bookstore',
            'connections' => ['bookstore']
        ],
        'generator' => [
            'defaultConnection' => 'bookstore',
            'connections' => ['bookstore']
        ],
        'paths' => [
            'projectDir' => '.',
            'schemaDir' => './schema/propel',
            'outputDir' => '.',
            'phpDir' => './generated-classes/propel',
            'phpConfDir' => './generated-conf/propel',
            'migrationDir' => './generated-migrations/propel',
            'sqlDir' => './generated-sql/propel',
            'composerDir' => '.'
        ]
    ]
];
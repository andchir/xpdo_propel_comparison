<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// setup the autoloading
require_once __DIR__ . '/../vendor/autoload.php';

//config
require_once __DIR__ . '/../config.php';

$xpdo = \xPDO\xPDO::getInstance('aMySQLDatabase', [
    \xPDO\xPDO::OPT_CACHE_PATH => __DIR__ . '/xpdo/cache/',
    \xPDO\xPDO::OPT_HYDRATE_FIELDS => true,
    \xPDO\xPDO::OPT_HYDRATE_RELATED_OBJECTS => true,
    \xPDO\xPDO::OPT_HYDRATE_ADHOC_FIELDS => true,
    \xPDO\xPDO::OPT_CONNECTIONS => [
        [
            'dsn' => 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['dbname'] . ';charset=utf8',
            'username' => $config['db']['username'],
            'password' => $config['db']['password'],
            'options' => [
                \xPDO\xPDO::OPT_CONN_MUTABLE => true,
            ],
            'driverOptions' => [],
        ],
    ],
]);

$xpdo->setLogLevel(\xPDO\xPDO::LOG_LEVEL_INFO);
$xpdo->setLogTarget(XPDO_CLI_MODE ? 'ECHO' : 'HTML');

$manager= $xpdo->getManager();
$generator= $manager->getGenerator();

$schema = __DIR__ . '/schema/schema.xml';
$target = __DIR__ . '/model/';
$generator->parseSchema($schema, $target);

echo '<br>Completed.';

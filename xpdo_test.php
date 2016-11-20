<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

use xPDO\xPDO;
use bookstore\Book;

// setup the autoloading
require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/config.php';

$startTime = microtime(true);

$xpdo = xPDO::getInstance('aMySQLDatabase', [
    xPDO::OPT_CACHE_PATH => __DIR__ . '/xpdo/cache/',
    xPDO::OPT_HYDRATE_FIELDS => true,
    xPDO::OPT_HYDRATE_RELATED_OBJECTS => true,
    xPDO::OPT_HYDRATE_ADHOC_FIELDS => true,
    xPDO::OPT_CONNECTIONS => [
        [
            'dsn' => 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['dbname'] . ';charset=utf8',
            'username' => $config['db']['username'],
            'password' => $config['db']['password'],
            'options' => [
                xPDO::OPT_CONN_MUTABLE => true,
            ],
            'driverOptions' => [],
        ],
    ],
]);

$xpdo->setLogLevel(xPDO::LOG_LEVEL_INFO);
$xpdo->setLogTarget(XPDO_CLI_MODE ? 'ECHO' : 'HTML');

$query = $xpdo->newQuery('bookstore\Book');
$query->sortby('title','ASC');
$query->limit(300);
$books = $xpdo->getCollection('bookstore\Book', $query);
foreach($books as $book) {
    echo '<pre>' . print_r( $book->toJSON(), true ) . '</pre>';
}

$endTime = microtime(true);

echo '<br>Total records: ' . count( $books );
echo '<br>Total time: ' . sprintf('%f', ( $endTime - $startTime ));
echo '<br>Memory: ' . round(memory_get_usage()/1024/1024, 4) . ' MB';

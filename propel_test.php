<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// setup the autoloading
require_once __DIR__ . '/vendor/autoload.php';

$startTime = microtime(true);

// setup Propel
require_once __DIR__ . '/generated-conf/propel/config.php';

$books = BookQuery::create()
    ->orderByTitle()
    ->limit(10)
    ->find();

foreach($books as $book) {
    echo '<pre>' . print_r( $book->toJSON(), true ) . '</pre>';
}

$endTime = microtime(true);

echo '<br>Total records: ' . count( $books );
echo '<br>Total time: ' . sprintf('%f', ( $endTime - $startTime ));
echo '<br>Memory: ' . round(memory_get_usage()/1024/1024, 4) . ' MB';

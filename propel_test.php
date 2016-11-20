<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// setup the autoloading
require_once __DIR__ . '/vendor/autoload.php';

$limit = 300;
$startTime = microtime(true);

// setup Propel
require_once __DIR__ . '/generated-conf/propel/config.php';

$books = BookQuery::create()
    ->leftJoin('Book.Author')
    ->withColumn('Author.FirstName', 'AuthorFirstName')
    ->withColumn('Author.LastName', 'AuthorLastName')
    ->orderByTitle()
    ->limit($limit)
    ->find();

foreach($books as $book) {
    //$author = $book->getAuthor();
    //echo '<br>Author: ' . $author->getFirstName() . ' ' . $author->getLastName();
    echo '<pre>' . print_r( $book->toJSON(), true ) . '</pre>';
}

$endTime = microtime(true);

echo '<br>Total records: ' . $limit;
echo '<br>Total time: ' . sprintf('%f', ( $endTime - $startTime ));
echo '<br>Memory: ' . round(memory_get_usage()/1024/1024, 4) . ' MB';

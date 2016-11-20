<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// setup the autoloading
require_once __DIR__ . '/vendor/autoload.php';

// setup Propel
require_once __DIR__ . '/generated-conf/propel/config.php';

$count_authors = 10;
$count_publishers = 10;
$count_books = 100;

$faker = Faker\Factory::create();

for ($i=0; $i < $count_authors; $i++) {
    
    $author = new Author();
    $author->setFirstName($faker->firstNameMale);
    $author->setLastName($faker->lastName);
    $author->save();
  
}

for ($i=0; $i < $count_publishers; $i++) {
    
    $publisher = new Publisher();
    $publisher->setName( $faker->name() );
    $publisher->save();
  
}

for ($i=0; $i < $count_books; $i++) {
    
    $author = AuthorQuery::create()->addAscendingOrderByColumn('rand()')->findOne();
    $publisher = PublisherQuery::create()->addAscendingOrderByColumn('rand()')->findOne();
    
    $book = new Book();
    $book->setTitle( $faker->sentence(6, true) );
    $book->setISBN( $faker->randomNumber( 8 ) );
    $book->setPubDate( $faker->unixTime() );
    $book->setPrice( $faker->randomNumber( 4 ) );
    $book->setAuthor( $author );
    $book->setPublisher( $publisher );
    $book->save();
  
}


echo "Сгенерировано: {$count_authors} авторов, {$count_publishers} издательств, {$count_books} книг.";

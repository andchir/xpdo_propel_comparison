<?php
namespace bookstore\mysql;

use xPDO\xPDO;

class Book extends \bookstore\Book
{

    public static $metaMap = array (
        'package' => 'bookstore',
        'version' => '1.1',
        'table' => 'book',
        'extends' => 'xPDO\\Om\\xPDOSimpleObject',
        'fields' => 
        array (
            'id' => NULL,
            'title' => NULL,
            'isbn' => NULL,
            'pub_date' => NULL,
            'price' => NULL,
            'publisher_id' => NULL,
            'author_id' => NULL,
        ),
        'fieldMeta' => 
        array (
            'id' => 
            array (
                'dbtype' => 'integer',
                'precision' => '11',
                'phptype' => 'integer',
                'required' => 'true',
                'index' => 'pk',
                'generated' => 'native',
            ),
            'title' => 
            array (
                'dbtype' => 'varchar',
                'phptype' => 'string',
                'size' => '255',
                'required' => 'true',
            ),
            'isbn' => 
            array (
                'dbtype' => 'varchar',
                'phptype' => 'string',
                'size' => '24',
                'required' => 'true',
                'phpName' => 'ISBN',
            ),
            'pub_date' => 
            array (
                'dbtype' => 'integer',
                'phptype' => 'integer',
                'size' => '20',
                'required' => 'true',
            ),
            'price' => 
            array (
                'dbtype' => 'integer',
                'phptype' => 'integer',
                'size' => '20',
                'required' => 'true',
            ),
            'publisher_id' => 
            array (
                'dbtype' => 'integer',
                'phptype' => 'integer',
                'required' => 'true',
            ),
            'author_id' => 
            array (
                'dbtype' => 'integer',
                'phptype' => 'integer',
                'required' => 'true',
            ),
        ),
        'composites' => 
        array (
            'Author' => 
            array (
                'class' => 'bookstore\\Author',
                'local' => 'author_id',
                'foreign' => 'id',
                'cardinality' => 'one',
                'owner' => 'local',
            ),
            'Publisher' => 
            array (
                'class' => 'bookstore\\Publisher',
                'local' => 'publisher_id',
                'foreign' => 'id',
                'cardinality' => 'one',
                'owner' => 'local',
            ),
        ),
    );
}

<?php
namespace bookstore\mysql;

use xPDO\xPDO;

class Author extends \bookstore\Author
{

    public static $metaMap = array (
        'package' => 'bookstore',
        'version' => '1.1',
        'table' => 'author',
        'extends' => 'xPDO\\Om\\xPDOSimpleObject',
        'fields' => 
        array (
            'id' => NULL,
            'first_name' => NULL,
            'last_name' => NULL,
        ),
        'fieldMeta' => 
        array (
            'id' => 
            array (
                'dbtype' => 'integer',
                'phptype' => 'integer',
                'required' => 'true',
                'primaryKey' => 'true',
                'autoIncrement' => 'true',
            ),
            'first_name' => 
            array (
                'dbtype' => 'varchar',
                'phptype' => 'string',
                'size' => '128',
                'required' => 'true',
            ),
            'last_name' => 
            array (
                'dbtype' => 'varchar',
                'phptype' => 'string',
                'size' => '128',
                'required' => 'true',
            ),
        ),
        'aggregates' => 
        array (
            'Books' => 
            array (
                'class' => 'Books',
                'local' => 'id',
                'foreign' => 'author_id',
                'cardinality' => 'one',
                'owner' => 'foreign',
            ),
        ),
    );
}

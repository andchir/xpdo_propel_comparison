<?php
namespace bookstore\mysql;

use xPDO\xPDO;

class Publisher extends \bookstore\Publisher
{

    public static $metaMap = array (
        'package' => 'bookstore',
        'version' => '1.1',
        'table' => 'publisher',
        'precision' => '11',
        'extends' => 'xPDO\\Om\\xPDOSimpleObject',
        'fields' => 
        array (
            'id' => NULL,
            'name' => NULL,
        ),
        'fieldMeta' => 
        array (
            'id' => 
            array (
                'dbtype' => 'integer',
                'phptype' => 'integer',
                'required' => 'true',
                'index' => 'pk',
                'generated' => 'native',
            ),
            'name' => 
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
                'class' => 'bookstore\\Books',
                'local' => 'id',
                'foreign' => 'publisher_id',
                'cardinality' => 'one',
                'owner' => 'foreign',
            ),
        ),
    );
}

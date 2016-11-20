<?php
namespace bookstore;

use xPDO\xPDO;

/**
 * Class Book
 *
 * @property integer $id
 * @property string $title
 * @property string $isbn
 * @property integer $pub_date
 * @property integer $price
 * @property integer $publisher_id
 * @property integer $author_id
 *
 * @property \bookstore\Author $Author
 * @property \bookstore\Publisher $Publisher
 *
 * @package bookstore
 */
class Book extends \xPDO\Om\xPDOSimpleObject
{
}

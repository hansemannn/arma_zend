<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class BookTable extends StandardTable
{
	protected $orderBy = 'title ASC';
	protected $fields = array('title', 'id_author', 'pages', 'releaseDate');
}
<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class AuthorTable extends AbstractTable
{
	protected $orderBy = 'last_name ASC';
	protected $fields = array('first_name', 'last_name');

}
<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class UserTable extends StandardTable
{
	protected $orderBy = 'username ASC';
	protected $fields = array('username', 'role', 'password');

}
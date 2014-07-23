<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class AuthorTable extends AbstractTable
{
	protected $orderBy = 'last_name ASC';
	protected $fields = array('first_name', 'last_name');

	public function getOptionsArray() {
		$authors = $this->fetchAll();
		$options = array();
		
		if(count($authors) > 0) {
			foreach($authors as $author) {
				$options[$author->id] = $author->last_name . ', ' . $author->first_name;
			}
		}
		
		return $options;
	}
}
<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class StandardTable
{
	protected $tableGateway;
	protected $orderBy = '';
	protected $fields = array();

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll()
	{
		if (trim($this->orderBy != ''))
		{
			$orderBy = $this->orderBy;
			$resultSet = $this->tableGateway->select(
				function(Select $select) use ($orderBy)
				{
					$select->order($orderBy);
				}
			);	
		}
		else
		{
			$resultSet = $this->tableGateway->select();
		}
		
		return $resultSet;
	}

	public function saveEntry($entry)
	{
		$id = (int)$entry->id;

		$data = array();
		foreach($this->fields as $field)
		{
			$data[$field] = $entry->$field;
		}

		if ($id == 0)
		{
			$this->tableGateway->insert($data);
			$entry->id = $this->tableGateway->lastInsertValue;
		}
		else
		{
			$this->tableGateway->update($data, array('id' => $id));
		}
		return $entry;
	}

	public function getEntry($id = 0)
	{
		$id = (int)$id;
		$rowset = $this->tableGateway->select(array('id' => $id));
		$row = $rowset->current();
		return $row;
	}

	public function deleteEntry($id = 0)
	{
		$id = (int)$id;
		$rowset = $this->tableGateway->select(array('id' => $id));
		$row = $rowset->current();

		if ($row)
		{
			$this->tableGateway->delete(array('id' => $id));
		}
	}
}
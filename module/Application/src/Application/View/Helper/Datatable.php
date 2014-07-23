<?php

namespace Application\View\Helper;
use Zend\View\Helper\AbstractHelper;

class Datatable extends AbstractHelper {

	private $data;
	private $keys;
	private $actions;
	private $route;

	public function __invoke($data, $route, $args) {
	
		$this->data = $data->toArray();
		$this->route = $route;
		$this->keys = $args['keys'];
		$this->actions = $args['actions'];
					
		return '<table class="table table-striped">
					<thead>
						<tr class="active">
							'.$this->getTableKeysHtml().'
						</tr>
					</thead>
					<tbody>
						'.$this->getTableContentHtml().'
					</tbody>
				</table>';
	}
	
	private function getTableContentHtml() {
		$output = '';
		
		for($i = 0; $i < count($this->data); $i++) {
			$row = $this->createRow($this->data[$i]);			
			$output .= $row;
		}		
				
		return $output;
	}
	
	private function createRow($rowData) {
		$row = '<tr>';
		$column = $rowData;
			
		foreach($this->keys as $key) {
			$type = (array_key_exists('type', $key)) ? $key['type'] : null;
			$row .= '<td>'.$this->formatKey($column[$key['name']], $type).'</td>';	
		}
		
		if($this->actions) {
			$row .= '<td>';
			foreach($this->actions as $action) {
				$row .= $this->createAction($action, $column['id']);
			}
			$row .= '</td>';
		}
				
		$row .= '</tr>';	
		
		return $row;	
	}
	
	private function formatKey($key, $type = null) {
		$convertdate = $this->view->plugin('convertdate');
		if($type) {
			switch($type) {
				case 'date': return $convertdate($key);
				break;
				// Todo: Implement more useful HelperFunctions
				default: return $key;
			}
		}
			
		return $key;
	}
	
	private function createAction($action, $referenceId) {
		$output = '';
		$urlHelper = $this->view->plugin('url');
		$output .= '<a class="btn btn-default" href="'.$urlHelper($this->route, array('action'=>$action['name'], 'id'=>$referenceId)).'"';
		
		if($action['name'] == 'delete')
			$output .= 'onClick="return confirm(\'Wirklich löschen?\');"';
		
		$output .= '>'.$action['title'].'</a>&nbsp;';	
		
		return $output;
	}
	
	private function getTableKeysHtml() {
		$output = '';
		
		foreach($this->keys as $key) {
			$output .= '<td>'.$key['headline'].'</td>';
		}
		
		if($this->actions)
			$output .= '<td>Bearbeiten</td>';
		
		return $output;
	}
}
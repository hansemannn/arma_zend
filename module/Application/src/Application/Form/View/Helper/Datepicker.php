<?php

namespace Application\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormDate;
use Zend\Form\Exception;
use Zend\Form\Element\Date;

class Datepicker extends FormDate {
	public function render(ElementInterface $element) {
		return '
			<div class="input-group date datetimepicker" data-date-format="YYYY-MM-DD">
				<input name="'.$element->getName().'" type="text" class="form-control datepicker" value="'.$element->getValue().'" />
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>
		';
	}
}
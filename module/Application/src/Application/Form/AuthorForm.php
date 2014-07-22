<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\Session\Container;

class AuthorForm extends Form
{
	public function __construct()
	{
		parent::__construct('author');

		$this->setAttribute('method', 'post');

		$this->add(
			array(
				'name' => 'id',
				'type' => 'Hidden',
			)
		);

		$this->add(
			array(
				'name' => 'first_name',
				'type' => 'Text',
				'attributes' => array(
					'id' => 'first_name',
				),
				'options' => array(
					'label' => 'Vorname',
				)
			)
		);

		$this->add(
			array(
				'name' => 'last_name',
				'type' => 'Text',
				'attributes' => array(
					'id' => 'last_name',
				),
				'options' => array(
					'label' => 'Nachname',
				)
			)
		);

		$this->add(
			array(
				'name' => 'author_id',
				'type' => 'Text',
				'attributes' => array(
					'id' => 'author_id',
				),
				'options' => array(
					'label' => 'Autor-ID',
				)
			)
		);

		$this->add(
			array(
				'name' => 'submit',
				'type' => 'Submit',
				'attributes' => array(
					'value' => 'Speichern',
					'id' => 'author_submit',
				)
			)
		);


	}
}
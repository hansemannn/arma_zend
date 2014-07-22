<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\Session\Container;

class UserForm extends Form
{
	public function __construct()
	{
		parent::__construct('user');

		$this->setAttribute('method', 'post');

		$this->add(
			array(
				'name' => 'id',
				'type' => 'Hidden',
			)
		);

		$this->add(
			array(
				'name' => 'username',
				'type' => 'Text',
				'attributes' => array(
					'id' => 'username',
				),
				'options' => array(
					'label' => 'Username',
				)
			)
		);

		$this->add(
			array(
				'name' => 'password',
				'type' => 'Password',
				'attributes' => array(
					'id' => 'password',
				),
				'options' => array(
					'label' => 'Passwort',
				)
			)
		);
		
		$this->add(
			array(
				'name' => 'role',
				'type' => 'Text',
				'attributes' => array(
					'id' => 'role',
				),
				'options' => array(
					'label' => 'Rolle',
				)
			)
		);

		$this->add(
			array(
				'name' => 'submit',
				'type' => 'Submit',
				'attributes' => array(
					'value' => 'Speichern',
					'id' => 'user_submit',
				)
			)
		);


	}
}
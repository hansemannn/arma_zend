<?php
namespace Application\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;


class User extends AbstractModel
{
	public $id;
	public $username;
	public $role;
	public $password;

	protected $inputFilter;
	protected $fields;

	public function __construct() {
		$this->propertyNames = array(
			'id',
			'username',
			'password',
			'role'
		);
	}

	public function getInputFilter()
	{
		if (!$this->inputFilter)
		{
			$inputFilter = new InputFilter();
			$factory = new InputFactory();

			$inputFilter->add(
				$factory->createInput(
					array(
						'name' => 'id',
						'required' => true,
						'filters' => array(
							array('name' => 'Int')
						)
					)
				)
			);

			$inputFilter->add(
				$factory->createInput(
					array(
						'name' => 'username',
						'required' => true,
						'filters' => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim')
						),
						'validators' => array(
							array(
								'name' => 'StringLength',
								'options' => array(
									'encoding' => 'UTF-8',
									'min' => 2,
									'max' => 30
								)
							)
						)
					)
				)
			);

			$inputFilter->add(
				$factory->createInput(
					array(
						'name' => 'password',
						'required' => true,
						'filters' => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim')
						),
						'validators' => array(
							array(
								'name' => 'StringLength',
								'options' => array(
									'encoding' => 'UTF-8',
									'min' => 6,
									'max' => 30
								)
							)
						)
					)
				)
			);

			$inputFilter->add(
				$factory->createInput(
					array(
						'name' => 'role',
						'required' => true,
						'filters' => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim')
						),
					)
				)
			);

			$this->inputFilter = $inputFilter;
		}
		return $this->inputFilter;
	}
}

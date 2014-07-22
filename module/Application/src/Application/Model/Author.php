<?php
namespace Application\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;


class Author extends AbstractModel 
{
	public $id;
	public $first_name;
	public $last_name;
	
	protected $inputFilter;
	protected $fields;

	public function __construct() {
		$this->propertyNames = array(
			'id', 
			'first_name', 
			'last_name'
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
						'name' => 'first_name',
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
						'name' => 'last_name',
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

			$this->inputFilter = $inputFilter;
		}
		return $this->inputFilter;
	}
}


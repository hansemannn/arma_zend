<?php
namespace Application\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;


class Book extends StandardModel 
{
	public $id;
	public $title;
	public $id_author;
	public $pages;
	public $releaseDate;
	protected $inputFilter;
	protected $fields;


	public function __construct() {
		$this->propertyNames = array(
			'id', 
			'title', 
			'id_author', 
			'pages', 
			'releaseDate'
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
						'name' => 'title',
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
									'min' => 5,
									'max' => 100
								)
							)
						)
					)
				)
			);

			$inputFilter->add(
				$factory->createInput(
					array(
						'name' => 'pages',
						'required' => true,
						'filters' => array(
						),
						'validators' => array(
							array(
								'name' => 'Digits',
							)
						)
					)
				)
			);

			$inputFilter->add(
				$factory->createInput(
					array(
						'name' => 'releaseDate',
						'required' => true,
						'validators' => array(
							array(
								'name' => 'NotEmpty',
								'options' => array(
									'messages' => array(
										\Zend\Validator\NotEmpty::IS_EMPTY => 'Bitte geben Sie das Erscheinungsjahr ein.'
									),
								),
							),
							array(
								'name' => 'Date',
								'options' => array(
									'messages' => array(
										\Zend\Validator\Date::INVALID_DATE => 'Das Datum stimmt nicht.',
										\Zend\Validator\Date::FALSEFORMAT => 'Falsches Format',
									)
								)
							)	
						),
					)
				)
			);

			$this->inputFilter = $inputFilter;
		}
		return $this->inputFilter;
	}
}


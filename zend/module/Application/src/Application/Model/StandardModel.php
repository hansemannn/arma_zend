<?php
namespace Application\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


abstract class StandardModel implements InputFilterAwareInterface
{
	protected $propertyNames;
	protected $inputFilter;

	public function exchangeArray(array $properties)
	{
		foreach($this->propertyNames as $propertyName)
		{
			$this->$propertyName = (isset($properties[$propertyName])) ? $properties[$propertyName] : null;	
		}
	}

	public function getArrayCopy()
	{
		return get_object_vars($this);
	}
	
	public function setInputFilter(InputFilterInterface $inputFilter)
	{

	}
}
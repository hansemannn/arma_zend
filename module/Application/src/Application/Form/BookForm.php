<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\Session\Container;

class BookForm extends Form
{

	private $authors;
	
	public function __construct($authors = array())
	{
		parent::__construct('book');
		
		$this->authors = $authors;		
		$this->setAttribute('method', 'post');

		array_unshift($this->authors, '-- Bitte auswählen --');
		
		$this->add(
			array(
				'name' => 'id',
				'type' => 'Hidden',
			)
		);

		$this->add(
			array(
				'name' => 'title',
				'type' => 'Text',
				'attributes' => array(
					'id' => 'book_title',
				),
				'options' => array(
					'label' => 'Titel',
				)
			)
		);

		$this->add(
			array(
				'name' => 'id_author',
				'type' => 'Select',
				'attributes' => array(
					'id' => 'book_id_author',
				),
				'options' => array(
					'label' => 'Autor',
					'options' => $this->authors
				)
			)
		);

		$this->add(
			array(
				'name' => 'pages',
				'type' => 'Text',
				'attributes' => array(
					'id' => 'book_pages',
				),
				'options' => array(
					'label' => 'Seiten',
				)
			)
		);

		$this->add(
			array(
				'name' => 'releaseDate',
				'type' => 'Text',
				'attributes' => array(
					'id' => 'book_releaseDate',
				),
				'options' => array(
					'label' => 'Erscheinungsdatum',
				)
			)
		);

		// Hier bitte Felder für pages, releaseDate und id_author einfügen!!!

		$this->add(
			array(
				'name' => 'submit',
				'type' => 'Submit',
				'attributes' => array(
					'value' => 'Speichern',
					'id' => 'book_submit',
				)
			)
		);


	}
}
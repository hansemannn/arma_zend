<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\Session\Container;

class BookForm extends Form
{
	public function __construct()
	{
		parent::__construct('book');

		$this->setAttribute('method', 'post');

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
				'type' => 'Text',
				'attributes' => array(
					'id' => 'book_id_author',
				),
				'options' => array(
					'label' => 'Autor',
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
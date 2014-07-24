<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Frontend\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Backend\Form\BookForm;
use Application\Model\Book;

class BookController extends AbstractActionController
{
	protected $bookTable;
	protected $authorTable;

    public function indexAction()
    {
    	$books = $this->getBookTable()->fetchAll();

        return new ViewModel(
        	array(
        		'books' => $books
        	)
        );
    }

    public function addAction()
    {
    	$authors = $this->getAuthorTable()->getOptionsArray();
    	$form = new BookForm($authors);

    	$request = $this->getRequest();
    	if ($request->isPost())
    	{
    		$book = new Book();
    		$form->setInputFilter($book->getInputFilter());

    		$form->setData($request->getPost());

    		if ($form->isValid())
    		{
    			$book->exchangeArray($form->getData());
    			$book = $this->getBookTable()->saveEntry($book);
    			return $this->redirect()->toRoute('book');
    		}
    	}

    	return new ViewModel(
        	array(
        		'form' => $form,
        	)
        );
    }

    public function editAction()
    {
    	$id = (int) $this->params()->fromRoute('id', 0);
    	if (!$id)
    	{
    		return $this->redirect()->toRoute('book');
    	}

    	try
    	{
    		$book = $this->getBookTable()->getEntry($id);
    	}
    	catch (\Exception $e)
    	{
    		return $this->redirect()->toRoute('book');
    	}


    	$authors = $this->getAuthorTable()->getOptionsArray();
    	$form = new BookForm($authors);
    	$form->bind($book);

    	$request = $this->getRequest();
    	if ($request->isPost())
    	{
    		$form->setInputFilter($book->getInputFilter());

    		$form->setData($request->getPost());

    		if ($form->isValid())
    		{
    			$book = $this->getBookTable()->saveEntry($form->getData());
    			return $this->redirect()->toRoute('book');
    		}
    	}

    	return new ViewModel(
        	array(
        		'form' => $form,
        		'id' => $id
        	)
        );
    }

    public function deleteAction()
    {
    	$id = (int) $this->params()->fromRoute('id', 0);
    	if (!$id)
    	{
    		return $this->redirect()->toRoute('book');
    	}

    	$this->getBookTable()->deleteEntry($id);
		return $this->redirect()->toRoute('book');
    }

    public function showAction()
    {
    	$id = (int) $this->params()->fromRoute('id', 0);
    	if (!$id)
    	{
    		return $this->redirect()->toRoute('book');
    	}

    	$book = $this->getBookTable()->getEntry($id);

		return new ViewModel(
        	array(
        		'book' => $book,
        	)
        );
    }

    public function bjoernAction()
    {
    	return new ViewModel();
    }

    public function listAction()
    {
    	return new ViewModel();
    }

    public function getBookTable()
    {
    	if (!$this->bookTable)
    	{
    		$sm = $this->getServiceLocator();
    		$this->bookTable = $sm->get('Application\Model\BookTable');
    	}
    	return $this->bookTable;
    }

    public function getAuthorTable()
    {
    	if (!$this->authorTable)
    	{
    		$sm = $this->getServiceLocator();
    		$this->authorTable = $sm->get('Application\Model\AuthorTable');
    	}
    	return $this->authorTable;
    }
}

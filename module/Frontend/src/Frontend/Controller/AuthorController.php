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
use Application\Form\AuthorForm;
use Application\Model\Author;

class AuthorController extends AbstractActionController
{
	protected $authorTable;

    public function indexAction()
    {
    	/*

    	$author = new Author();
    	$author->first_name = 'Hans';
    	$author->last_name = 'Knoechel';

    	$this->getAuthorTable()->saveEntry($author);

    	*/

    	$authors = $this->getAuthorTable()->fetchAll();

        return new ViewModel(
        	array(
        		'authors' => $authors,
        	)
        );
    }

    public function addAction()
    {
    	$form = new AuthorForm();

    	$request = $this->getRequest();
    	if ($request->isPost())
    	{
    		$author = new Author();
    		$form->setInputFilter($author->getInputFilter());

    		$form->setData($request->getPost());

    		if ($form->isValid())
    		{
    			$author->exchangeArray($form->getData());
    			$author = $this->getAuthorTable()->saveEntry($author);
    			return $this->redirect()->toRoute('author');
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
    		return $this->redirect()->toRoute('author');
    	}

    	try
    	{
    		$author = $this->getAuthorTable()->getEntry($id);
    	}
    	catch (\Exception $e)
    	{
    		return $this->redirect()->toRoute('author');
    	}


    	$form = new AuthorForm();
    	$form->bind($author);

    	$request = $this->getRequest();
    	if ($request->isPost())
    	{
    		$form->setInputFilter($author->getInputFilter());

    		$form->setData($request->getPost());

    		if ($form->isValid())
    		{
    			$author = $this->getAuthorTable()->saveEntry($form->getData());
    			return $this->redirect()->toRoute('author');
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
    		return $this->redirect()->toRoute('author');
    	}

    	$this->getAuthorTable()->deleteEntry($id);
		return $this->redirect()->toRoute('author');
    }

    public function showAction()
    {
    	$id = (int) $this->params()->fromRoute('id', 0);
    	if (!$id)
    	{
    		return $this->redirect()->toRoute('author');
    	}

    	$author = $this->getAuthorTable()->getEntry($id);

		return new ViewModel(
        	array(
        		'author' => $author,
        	)
        );
    }

    public function listAction()
    {
    	return new ViewModel();
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

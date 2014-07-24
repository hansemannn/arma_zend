<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Backend\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Backend\Form\UserForm;
use Application\Model\User;

class UserController extends AbstractActionController
{
	protected $userTable;

    public function indexAction()
    {
    	/*
    	
    	$user = new User();
    	$user->username = 'hansknoechel';
    	$user->password = 'meinpasswort';
    	$user->role = 0;

    	$this->getUserTable()->saveEntry($user);
    	
    	*/

    	$users = $this->getUserTable()->fetchAll();

        return new ViewModel(
        	array(
        		'users' => $users,
        	)
        );
    }

    public function addAction()
    {
    	$form = new UserForm();

    	$request = $this->getRequest();
    	if ($request->isPost())
    	{
    		$user = new User();
    		$form->setInputFilter($user->getInputFilter());

    		$form->setData($request->getPost());

    		if ($form->isValid())
    		{
    			$user->exchangeArray($form->getData());
    			$user = $this->getUserTable()->saveEntry($user);
    			return $this->redirect()->toRoute('user');
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
    		return $this->redirect()->toRoute('user');
    	}

    	try 
    	{
    		$user = $this->getUserTable()->getEntry($id);
    	}
    	catch (\Exception $e)
    	{
    		return $this->redirect()->toRoute('user');
    	}
    	
    	$form = new UserForm();
    	$form->bind($user);

    	$request = $this->getRequest();
    	if ($request->isPost())
    	{
    		$form->setInputFilter($user->getInputFilter());

    		$form->setData($request->getPost());

    		if ($form->isValid())
    		{
    			$user = $this->getUserTable()->saveEntry($form->getData());
    			return $this->redirect()->toRoute('user');
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
    		return $this->redirect()->toRoute('user');
    	}

    	$this->getUserTable()->deleteEntry($id);
		return $this->redirect()->toRoute('user');
    }

    public function showAction()
    {
    	$id = (int) $this->params()->fromRoute('id', 0);
    	if (!$id)
    	{
    		return $this->redirect()->toRoute('user');
    	}

    	$user = $this->getUserTable()->getEntry($id);

		return new ViewModel(
        	array(
        		'user' => $user,
        	)
        );
    }

    public function listAction()
    {
    	return new ViewModel();
    }

    public function getUserTable()
    {
    	if (!$this->userTable)
    	{
    		$sm = $this->getServiceLocator();
    		$this->userTable = $sm->get('Application\Model\UserTable');
    	}
    	return $this->userTable;
    }
}

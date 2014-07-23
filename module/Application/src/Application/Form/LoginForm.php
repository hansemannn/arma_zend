<?php
namespace Application\Form;

use Zend\Form\Form;
use Zend\Session\Container;

class LoginForm extends Form
{

    public function __construct($name = null, $ajax = false, $sl = null)
    {
        // we want to ignore the name passed
        parent::__construct('login');
        $this->serviceLocator = $sl;
        $this->setAttribute('method', 'post');
        if ($ajax)
        {
            $this->setAttribute('onClick', 'return false;');
        }
       
        $this->add(array(
            'name' => 'username',
            'type' => 'Text',
            'attributes' => array(
                'id' => 'login_username',
            ),
            'options' => array(
                'label' => 'Benutzername',
            ),
        ));

         $this->add(array(
            'name' => 'password',
            'type' => 'Password',
            'attributes' => array(
                'id' => 'login_password',
            ),
            'options' => array(
                'label' => 'Passwort',
            ),
        ));

       
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Anmelden',
                'id' => 'submitbutton',
                'class' => 'form-control'
            ),
        ));

        $this->add(array( 
            'name' => 'csrf', 
            'type' => 'Zend\Form\Element\Csrf', 
        ));   

    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function getAuthorTable()
    {

        if (!$this->authorTable) {
            $sm = $this->getServiceLocator();
            $this->authorTable = $sm->get('Backend\Model\AuthorTable');
        }
        return $this->authorTable;
    }
}
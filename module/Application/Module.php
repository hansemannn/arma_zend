<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Application\Model\Book;
use Application\Model\BookTable;
use Application\Model\Author;
use Application\Model\AuthorTable;
use Application\Model\User;
use Application\Model\UserTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;


class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getViewHelperConfig() {
		return array(
			'factories' => array(
				'convertdate' => function($sm) {
					$helper = new View\Helper\Convertdate;
					return $helper;
				},
				'datatable' => function($sm) {
					$helper = new View\Helper\Datatable;
					return $helper;
				}
			),
			'invokables' => array(
				'formdate' => 'Application\Form\View\Helper\Datepicker'
			)
		);   
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Application\Model\BookTable' => function($sm)
                {
                    $tableGateway = $sm->get('BookTableGateway');
                    $table = new BookTable($tableGateway);
                    return $table;
                },
                'Application\Model\AuthorTable' => function($sm)
                {
                    $tableGateway = $sm->get('AuthorTableGateway');
                    $table = new AuthorTable($tableGateway);
                    return $table;
                },
                'Application\Model\UserTable' => function($sm)
                {
                    $tableGateway = $sm->get('UserTableGateway');
                    $table = new UserTable($tableGateway);
                    return $table;
                },                
                'BookTableGateway' => function($sm)
                {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Book());
                    return new TableGateway('book', $dbAdapter, null, $resultSetPrototype);
                },
                'AuthorTableGateway' => function($sm)
                {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Author());
                    return new TableGateway('author', $dbAdapter, null, $resultSetPrototype);
                },
                'UserTableGateway' => function($sm)
                {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new User());
                    return new TableGateway('user', $dbAdapter, null, $resultSetPrototype);
                },
                'app_navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory'
            ),
        );
    }
}

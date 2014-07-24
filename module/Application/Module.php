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
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;
use Zend\Authentication\AuthenticationService;


class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

		// ACL
        $this->initAcl($e);
        $e->getApplication()->getEventManager()->attach('route', array($this, 'checkAcl'));

        // AuthService
        $viewModel = $e->getApplication()->getMvcEvent()->getViewModel();
        $authService = $e->getApplication()->getServiceManager()->get('AuthService');
        $viewModel->loggedIn = $authService->hasIdentity();
        $viewModel->identity = $authService->getIdentity();
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
                'app_navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
                'guest_navigation' => 'Application\Navigation\Service\GuestNavigationFactory',
                'member_navigation' => 'Application\Navigation\Service\MemberNavigationFactory',
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
                'AuthService' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $dbTableAuthAdapter = new DbTableAuthAdapter($dbAdapter,
                    	'user', 'username', 'password', 'MD5(?)'
                    );

                    $authService = new \Zend\Authentication\AuthenticationService();
                    $authService->setAdapter($dbTableAuthAdapter);

                    return $authService;
                }
            ),
        );
    }


    public function initAcl(MvcEvent $e) {


        $acl = new \Zend\Permissions\Acl\Acl();
        $acls = include __DIR__ . '/../../config/autoload/acl.php';
        $allResources = array();
        $allRoles = array();

        foreach($acls as $resource => $actions)
        {
            foreach($actions as $action => $roles)
            {
                $resourceString = $resource.'/'.$action;
                if(!$acl->hasResource($resourceString))
                {
                    $acl->addResource(new \Zend\Permissions\Acl\Resource\GenericResource($resourceString));
                }
                foreach($roles as $role)
                {
                    if (!in_array($role, $allRoles))
                    {
                        $allRoles[] = $role;
                        $role = new \Zend\Permissions\Acl\Role\GenericRole($role);
                        $acl->addRole($role);
                    }
                    $acl->allow($role, $resourceString);
                }
            }
        }

        //setting to view
        $e->getViewModel()->acl = $acl;
    }

    public function checkAcl(MvcEvent $e)
    {
        $userRole = 'guest';
        $app = $e->getTarget();
        $serviceManager = $app->getServiceManager();
        $authService = $serviceManager->get('AuthService');

        if ($authService->hasIdentity())
        {
            $user = $authService->getStorage()->read();

            $userRole = $user->role;
        }
        $controller = $e->getRouteMatch()->getMatchedRouteName('controller');
        $action = $e->getRouteMatch()->getParam('action');
        $route = $controller.'/'.$action;
        $allAccess = false;
        if ($e->getViewModel()->acl->hasResource($controller.'/all'))
        {
            if ($e->getViewModel()->acl->isAllowed($userRole, $controller.'/all'))
            {
                $allAccess = true;
            }
        }

        if (!$allAccess)
        {
            if ($e->getViewModel()->acl->hasResource($route))
            {
                if (!$e->getViewModel()->acl->isAllowed($userRole, $route))
                {
                    $e->getRouteMatch()
                    ->setParam('controller', 'Frontend\Controller\Book')
                    ->setParam('action', 'index');
                }
            }
            else
            {
                /*$e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function($e) {
                        $controller = $e->getTarget();
                        $controller->plugin('redirect')->toRoute('home');
                    }, 100);*/
                $e->getRouteMatch()
                ->setParam('controller', 'Frontend\Controller\Book')
                ->setParam('action', 'index');
            }
        }
    }
}

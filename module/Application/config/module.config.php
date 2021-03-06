<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'login' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/login[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Login',
                        'action'     => 'login',
                    ),
                ),
            ),

            'logout' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/logout[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Login',
                        'action'     => 'logout',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Book' => 'Application\Controller\BookController',
            'Application\Controller\Author' => 'Application\Controller\AuthorController',
            'Application\Controller\User' => 'Application\Controller\UserController',
            'Application\Controller\Login' => 'Application\Controller\LoginController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    'navigation' => array(
    	'default' => array(
			array(
				'label' => 'Bücher',
				'route' => 'book'
			),
			array(
				'label' => 'Autoren',
				'route' => 'author'
			),
			array(
				'label' => 'Nutzer',
				'route' => 'user'
			)
		),
    	'member' => array(
			array(
				'label' => 'Bücher',
				'route' => 'book'
			),
			array(
				'label' => 'Autoren',
				'route' => 'author'
			)
		),
    	'guest' => array(
			array(
				'label' => 'Bücher',
				'route' => 'book'
			),
			array(
				'label' => 'Login',
				'route' => 'login',
				'action' => 'login'
			)
		)
    ),
    'doctrine' => array(
        'driver' => array(
            'application_entities' => array(
              'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
              'cache' => 'array',
              'paths' => array(__DIR__ . '/../src/Application/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Application\Entity' => 'application_entities'
                ),
            )
        )
    ),
);

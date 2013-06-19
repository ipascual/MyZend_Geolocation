<?php

namespace Geolocation;

return array(
	'controllers' => array(
        'invokables' => array(
            'Geolocation\Controller\Index' => 'Geolocation\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            /* /module / controller / action */
            'geolocation' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/geolocation',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Geolocation\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
					),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller]/[:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array(
							),
                        ),
                    ),
				),
			),
        ),
	),
	'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Document')
				
            ),
            'odm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Document' => __NAMESPACE__ . '_driver',
				)
            )
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'geolocation' => __DIR__ . '/../view',
        ),
		'strategies' => array(
            'ViewJsonStrategy',
        ),
	),	
	'bjyauthorize' => array(
	    'guards' => array(
	        'BjyAuthorize\Guard\Controller' => array(
	        	array('controller' => 'Geolocation\Controller\Index', 'roles' => array('guest', 'user')),
	        ),
	    ),
	),

);
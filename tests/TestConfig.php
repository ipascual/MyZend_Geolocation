<?php
return array(
    'modules' => array(
        'Application',
        'MyZend',
		'DoctrineModule',
 		'DoctrineMongoODMModule',
 		'Geolocation'
    ),

    'module_listener_options' => array(
        'config_glob_paths'    => array(
            __DIR__.'/../config/autoload/{,*.}{global,local,testing}.php',
        ),
        'module_paths' => array(
            'module',
            'vendor',
        ),
    ),

);

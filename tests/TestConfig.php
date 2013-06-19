<?php
return array(
    'modules' => array(
        //'Application',
        //'DoctrineModule',
        //'DoctrineORMModule',

        'MyZend',

		//Database
		'DoctrineModule',
 		'DoctrineMongoODMModule',

		//User
 		'ZfcBase',     
 		'ZfcUser',
 		'ZfcUserDoctrineMongoODM',
 		'BjyAuthorize', 
 		'Facebook',
 		'User',
 		'Notification',

		//Application
        'Application',
 		//'Email',
 		//'Media',
 		'Geolocation'
    ),
    
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            '../../../config/autoload/{,*.}{global,local,testing}.php',
        ),
        'module_paths' => array(
            'module',
            'vendor',
        ),
    ),
    
);

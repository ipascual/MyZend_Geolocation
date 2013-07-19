<?php
return array(
    'modules' => array(
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
 		'Email',
 		'Media',
 		'Geolocation',
 		'Cms'
    ),
    
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            '../../../config/autoload/{,*.}{global,local}.php',
            '../../../config/autoload/env.'.(getenv('APPLICATION_ENV') ?: 'production').'.config.php',
        ),
        'module_paths' => array(
            'module',
            'vendor',
        ),
    ),
    
);

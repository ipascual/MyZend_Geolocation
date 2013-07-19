<?php
return array(
    'myzend'   => array(
    	'php_settings' => array(
        	'display_startup_errors'        => false,
        	'display_errors'                => false,
        	'max_execution_time'            => 60,
        ),
        'session' => array(
	    	'cookie_lifetime' => 3600, 
			'remember_me_seconds' => 1800,
			'name' => 'myzend'
    	),
    )
);
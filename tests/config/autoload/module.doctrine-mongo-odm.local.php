<?php
return array(
    'doctrine' => array(
        'odm_autoload_annotations' => true,

        'connection' => array(
            'odm_default' => array(
                'server'    => 'localhost',
                'port'      => '27017',
                'user'      => null,
                'password'  => null,
                'dbname'    => null,
                'options'   => array()
            ),
        ),

        'configuration' => array(
            'odm_default' => array(
                'metadata_cache'     => 'array',

                'driver'             => 'odm_default',

                'generate_proxies'   => true,
                'proxy_dir'          => __DIR__.'/../../data/cache',
                'proxy_namespace'    => 'Proxy',

                'generate_hydrators' => true,
                'hydrator_dir'       => __DIR__.'/../../data/cache',
                'hydrator_namespace' => 'Hydrator',

                'default_db'         => 'leaseapp-test',

                'filters'            => array()
            )
        ),

 		'driver' => array(),

        'documentmanager' => array(
            'odm_default' => array(
                'connection'    => 'odm_default',
                'configuration' => 'odm_default',
                'eventmanager' => 'odm_default'
            )
        ),

        'eventmanager' => array(
            'odm_default' => array(
                'subscribers' => array()
            )
        ),
    ),
);

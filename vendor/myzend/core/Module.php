<?php
namespace MyZend;

use Zend\EventManager\Event;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface,
    Zend\ModuleManager\Feature\ServiceProviderInterface,
    Zend\Session\SessionManager,
	Zend\Session\Config\StandardConfig;

require_once(dirname(__FILE__)."/src/lib/CommonFunctions.php");
require_once(dirname(__FILE__)."/src/lib/StringFunctions.php");

class Module implements 
	AutoloaderProviderInterface,
	ServiceProviderInterface
{
	
   public function onBootstrap(Event $e) {
   	
        $application = $e->getParam('application');
		$config = $application->getConfig();

		//PHP settings
        if(isset($config['myzend']['php_settings'])) {
            foreach($config['myzend']['php_settings'] as $key => $value) {
                ini_set($key, $value);
            }
        }
		
		$standardConfig = new StandardConfig();
		$standardConfig->setOptions(array(
			'cookie_lifetime'	  => $config['myzend']['session']['cookie_lifetime'],
    		'remember_me_seconds' => $config['myzend']['session']['remember_me_seconds'],
    		'name'                => $config['myzend']['session']['name'],
		));
		$manager = new SessionManager($standardConfig);
	}
   	
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
	public function getServiceConfig()
    {
		 return array(
            'factories' => array(
                'session' => function ($sm) {
                	$config = $sm->get('Config');
                    return new Factory\Session();
                }
			)
		);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }	
	
    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'flashMessenger' => function ($sm) {
                    $locator = $sm->getServiceLocator();
                    $viewHelper = new View\Helper\FlashMessenger();
                    return $viewHelper;
                },
                'inputErrors' => function ($sm) {
                    $locator = $sm->getServiceLocator();
                    $viewHelper = new View\Helper\InputErrors();
                    return $viewHelper;
                },
            ),
        );
    }
	
}
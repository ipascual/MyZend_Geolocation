<?php
namespace Geolocation;

use Locale;

use Geolocation\Service\GeolocationService;

use Geolocation\Helper\GoogleMapsHelper;
use Geolocation\Helper\GeolocationHelper;

class Module
{
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
        return array();
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function init($moduleManager)
    {
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        $sharedEvents->attach(__NAMESPACE__, \Zend\Mvc\MvcEvent::EVENT_DISPATCH, array($this, 'preDispatch'), 100);
	}

	public function preDispatch($event)
    {
        //ServiceManager
		$sm = $event->getApplication()->getServiceManager();

        //Services
		$event->getTarget()->geolocationService = new GeolocationService($sm);

        //Helpers
		$event->getTarget()->googleMapsHelper = new GoogleMapsHelper($sm);
		$event->getTarget()->geolocationHelper = new GeolocationHelper($sm);
    }

}
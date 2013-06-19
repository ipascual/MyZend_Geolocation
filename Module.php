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
    	//Unauthorized request after success login
    	$session = $event->getApplication()->getServiceManager()->get('session');
		if($lastRequest = $session->get("lastRequest")) {
			$event->getTarget()->getRequest()->setMethod($lastRequest["request"]->getMethod());
			$event->getTarget()->getRequest()->setPost($lastRequest["request"]->getPost());
			$event->getTarget()->getRequest()->setQuery($lastRequest["request"]->getQuery());
			
			//Delete request
			$session->set("lastRequest", null);				
		}
		
        //User logged
        $event->getTarget()->user = $event->getTarget()->authPlugin()->getIdentity();

		//Locale
		$locale = "en_US";
		$currency = "USD";
		if($event->getTarget()->user) {
			$locale = $event->getTarget()->user->getLocale();
			$currency = $event->getTarget()->user->getCurrency();
		}
		Locale::setDefault($locale);
		$viewHelperManager = $event->getApplication()->getServiceManager()->get("ViewHelperManager");
		$viewHelperManager->get("dateFormat")->setLocale($locale);
		$viewHelperManager->get("numberFormat")->setLocale($locale);
		$viewHelperManager->get("numberFormat")->setFormatStyle(\NumberFormatter::TYPE_DOUBLE); 
		$viewHelperManager->get("currencyFormat")->setLocale($locale)->setCurrencyCode($currency);

        //ServiceManager
		$sm = $event->getApplication()->getServiceManager();

        //Services
		$event->getTarget()->geolocationService = new GeolocationService($sm);
		//...

        //Helpers
		$event->getTarget()->googleMapsHelper = new GoogleMapsHelper($sm);	
		$event->getTarget()->geolocationHelper = new GeolocationHelper($sm);
       
        //Validator
        //...

        //Vendor Helpers
        $event->getTarget()->facebook = $sm->get('facebook');
        $event->getTarget()->email = $sm->get('email');
        $event->getTarget()->session = $sm->get('session');
    }
	
}
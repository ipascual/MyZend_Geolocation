<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Locale;
use Zend\ModuleManager\ModuleManager,
    Zend\ModuleManager\Feature\AutoloaderProviderInterface,
    Zend\ModuleManager\Feature\ConfigProviderInterface,
    Zend\ModuleManager\Feature\ServiceProviderInterface;

use User\Service\UserService;

use Notification\Helper\AlertHelper;

class Module
{
    public function onBootstrap($e)
    {
        $e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
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

        //ServiceManager
		$sm = $event->getApplication()->getServiceManager();
		
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

        //Services
        $event->getTarget()->userService = new UserService($sm);

        //Helpers
        //...
        $event->getTarget()->alertHelper = new AlertHelper($sm);
        
        //Validator
        //...
        
        //Vendor Helpers
        $event->getTarget()->facebook = $sm->get('facebook');
        $event->getTarget()->email = $sm->get('email');
        $event->getTarget()->session = $sm->get('session');
    }
	
}

<?php
namespace ApplicationTest;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use ApplicationTest\Bootstrap;
use User\Service\UserService;

class AbstractControllerZendtest extends AbstractHttpControllerTestCase
{
	protected $traceError = true;
	  
	/**
	 * Run before every test
	 * 
	 * Load fixtures
	 */
    public function setUp()
    {
		Bootstrap::setUp();		

        $this->setApplicationConfig(
            include __DIR__ . '/../TestConfig.php'
        );
		
    }
	
	protected function loginByEmail($email) {
        $sm = $this->getServiceManager();
        $authService = $sm->get('zfcuser_auth_service');
        $authAdapter = $sm->get('ZfcUser\Authentication\Adapter\AdapterChain');
        $authPlugin = new \User\Controller\Plugin\AuthPlugin();
        $authPlugin->setAuthService($authService);
        $authPlugin->setAuthAdapter($authAdapter);
		$authPlugin->loginByEmail($email);
	}
	
	protected function loginById($id){
		$userService = new UserService($this->getServiceManager());
		$user = $userService->findOneBy(array('id' => $id));
		if($user == null) {
			throw new \Exception("The user does not exist.");
		}
		$this->loginByEmail($user->getEmail());
	}

	/**
	 * Run after every test
	 * 
	 * Delete all collections
	 */
    public function tearDown()
    {
		Bootstrap::tearDown();		
	}
	
	protected function getServiceManager() {
		return Bootstrap::getServiceManager();
	}

}

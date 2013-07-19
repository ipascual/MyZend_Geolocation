<?php
namespace ApplicationTest\Tests;

use Zend\Stdlib\Parameters;

use ApplicationTest\AbstractControllerZendtest;

use User\Service\UserService;

class IndexControllerTest extends AbstractControllerZendtest
{

    public function testIndexActionCanBeAccessed()
    {
    	$this->loginByEmail("ignacio@bcn.com");
        $this->dispatch('/');

        $this->assertResponseStatusCode(200);
        $this->assertModuleName('application');
        $this->assertControllerName('Application\Controller\Index');
        $this->assertControllerClass('IndexController');
    }

}
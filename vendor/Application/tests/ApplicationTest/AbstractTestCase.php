<?php
namespace ApplicationTest;

use PHPUnit_Framework_TestCase;
use ApplicationTest\Bootstrap;

class AbstractTestCase extends PHPUnit_Framework_TestCase
{

	protected function alterConfig(array $config) {
		return $config;
	}
	
	protected function getServiceManager() {
		return Bootstrap::getServiceManager();		
	}

	/**
	 * Run before every test
	 * 
	 * Load fixtures
	 */
    public function setUp()
    {
		Bootstrap::setUp();		

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

}

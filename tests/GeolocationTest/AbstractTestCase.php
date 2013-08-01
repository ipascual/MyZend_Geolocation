<?php
namespace GeolocationTest;

use PHPUnit_Framework_TestCase;
use GeolocationTest\Bootstrap;

class AbstractTestCase extends PHPUnit_Framework_TestCase
{

	protected $controller;
	protected $request;
	protected $response;
	protected $routeMatch;
	protected $event;

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

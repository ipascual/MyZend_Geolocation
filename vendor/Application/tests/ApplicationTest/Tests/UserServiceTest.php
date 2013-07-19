<?php
namespace ApplicationTest\Tests;

use ApplicationTest\AbstractTestCase;

use User\Document\User;
use User\Service\UserService;

class UserServiceTest extends AbstractTestCase {
	
	public function setup() {
		parent::setup();
		
		$this->userService = new UserService($this->getServiceManager());
	}
	
	/**
	 * User change about me
	 */
	public function testUserChangeAbout() {
		//get var user-id
		$data["id"] = "50116983724f9a280a000000";
		$data["about"] = "bla bla bla bla ..........";
		//get user
		$filter = array("id"=>$data["id"]);

		//search the user
		$user = $this->userService->findOneBy($filter);

		//update values
		$user->setAboutMe($data["about"]);

		//save user
		$this->userService->save($user);

		//one or more results
		$this->assertNotEquals(0, count($user));

		//the result have to match
		$this->assertEquals($data["id"], $user->getId());
	}

}

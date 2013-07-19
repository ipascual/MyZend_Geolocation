<?php
namespace MyZend\Factory;

use Zend\Session\Container;
use MyZend\Factory\Session\Search;

class Session
{
	private $session; 
	
	public function __construct() {
		$this->session = new Container('base');
		if(! $this->session->offsetExists("search")) {
			$this->set("search", new Search());
		}
	}

	public function set($key, $value) {
		$this->session->offsetSet($key, $value);		
	}
	
	public function get($key) {
		return $this->session->offsetGet($key);		
	}


}
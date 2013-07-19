<?php
namespace MyZend\Factory\Session;

class Search {
	    
	public $query;
	public $limit;
	public $start;
	public $geolocationId;
	
	public function __construct() {
		$this->resetSearch();	
	}
	
    public function resetSearch($query = "") {
        $this->query = $query;
		$this->limit = 10;
		$this->start = 0;
		$this->geolocationId = null;
		
		return $this;
    }
    
    
}
<?php
/**
 *
 * @author Ignacio Pascual (using Geocoder package from Jörg Drzycimski (http://www.drzycimski.com))
 * 
 * @example How to use 
 * 
 * Declaration 
 * $googleMapsHelper = new GoogleMapsHelper($this->getServiceManager());
 * or
 * $googleMapsHelper = new GoogleMapsHelper($this->getServiceManager(), array("language" => "es"));
 * 
 * 
 * $googleMapsHelper->forwardSearch("Barcelona, Spain");
 * if($googleMapsHelper->getStatus() == $georequest::OK) {
 * 	var_dump($googleMapsHelper->getGeoData());
 * }
 * 
 */

namespace Geolocation\Helper;

use Zend\Http\Client;
use Zend\Json\Json;
 
class GoogleMapsHelper
{
	
	public function __construct($sm, $options = array()) {
		$this->dm = $sm->get('doctrine.documentmanager.odm_default');

		//Related services
		if($sm->has("email")) {
			$this->email = $sm->get("email");
		}

		//Set default options
		foreach($options as $key => $value) {
			$this->$key = $value;	
		}
	}
	
	/**
	* @class vars
	*/
	
    //Extra objects to log in case of error
    public $log;
    
	// Google´s geocode URL
	private $url = 'http://maps.google.com/maps/api/geocode/json?';
	
	// Params for request
	private $sensor 	= "false"; // REQUIRED FOR REQUEST!
	private $language 	= "en";
	
	// Cleartext translation of Google´s response (status)
	const OK					= 'OK';
	const ZERO_RESULTS			= 'ZERO_RESULTS';
	const OVER_QUERY_LIMIT		= 'OVER_QUERY_LIMIT';
	const REQUEST_DENIED		= 'REQUEST_DENIED';
	const INVALID_REQUEST		= 'INVALID_REQUEST';
	
	// Class vars
	private $response			= '';
	private $country_long		= '';
	private $country_short		= '';
	private $region_long		= '';
	private $region_short		= '';
	private $city				= '';
	private $address			= '';
	private $address_short		= '';
	private $address_street_number = '';
	private $post_code			= '';
	private $lat				= '';
	private $lng				= '';
	private $location_type		= '';
	private $status 			= '';
	
	/**
	* Forward search: string must be an address
	*
	* @param string $address 
	* @return obj $response
	*/
	public function forwardSearch($address)
	{
		$this->_clean();
		return $this->_sendRequest("address=" . urlencode(stripslashes($address)));
	}
	
	/**
	 * Return all data in an array
	 * 
	 */
	public function getGeoData() {
	    $data = array();
	    $data["country_name"] = $this->country_long; 
	    $data["country_code2"] = $this->country_short; 
	    $data["address"] = $this->address;
	    $data["address_short"] = $this->address_short;
		$data["address_street_number"] = $this->address_street_number;
	    $data["post_code"] = $this->post_code;
	    $data["city"] = $this->city;
	    $data["latitude"] = $this->lat;
	    $data["longitude"] = $this->lng;
		$data["region"] = $this->region_long;
		return $data;	     
	}
	
	/**
	* Reverse search: string must be latitude and longitude
	*
	* @param float $lat
	* @param float $lng 
	* @return obj $response
	*/
	public function reverseSearch($lat, $lng)
	{
		return $this->_sendRequest("latlng=" . (float) $lat . ',' . (float) $lng);
	} // end reverse

	/**
	* Search Address Components Object
	*
	* @param string $type 
	* @return object / false
	*/	
	function searchAddressComponents($type) {
		foreach($this->response->results[0]->address_components as $k=>$found){
			if(in_array($type, $found->types)){
				return $found;
			} 
		}
		return false;
	}

	/**
	* Send Google geocoding request
	*
	* @param string $search 
	* @return object response (body only)
	*/
	private function _sendRequest($search)
	{
		$client = new Client();
		$client->setUri($this->url . $search . '&language=' . strtolower($this->language) . '&sensor=' . strtolower($this->sensor));
		$client->setOptions(array(
			'maxredirects' => 0,
			'timeout'      => 30));
		$client->setHeaders(array(
    	'Accept-encoding' => 'json'));
		$response = $client->send();
		$body = $response->getBody();
		$this->response = Json::decode($body, Json::TYPE_OBJECT);
		$this->status = $this->response->status;
		if ($this->response->status == "OK") {
			// set some default values for reading
			$defaults = $this->_setDefaults();
			return $this->response;
		}
		else {
		    //Log error
		    $vars["log"]["message"] = "Google Lookup Failed: ".$this->response->status;
		    $objects[] = $search;
		    $objects[] = $this->response;
		    if(is_array($this->log)) {
		    	$objects = array_merge($this->log, $objects);
		    }
		    $vars["log"]["objects"] = $objects;
			//Admin mail
			//$email = $this->email->create($vars);
			//$email->setTemplateName("log");
			//$this->email->send($email);
		}
	} // end request
	
	/**
	* Parse JSON default values: map object values to readable content
	*
	* @param none 
	* @return none
	*/
	private function _setDefaults()
	{
		$country = $this->searchAddressComponents("country");
		if(isset($country->long_name))
			$this->country_long	= $country->long_name;
		if(isset($country->short_name))
			$this->country_short	= $country->short_name;
		$region = $this->searchAddressComponents("administrative_area_level_1");
		if(isset($region->long_name))
			$this->region_long = $region->long_name;
		if(isset($region->short_name))
			$this->region_short	= $region->short_name;
		$city = $this->searchAddressComponents("locality");
		if(isset($city->short_name))
			$this->city	= $city->short_name;
		if(isset($this->response->results[0]->formatted_address))
			$this->address = $this->response->results[0]->formatted_address;

		$street_number = $this->searchAddressComponents("street_number");
		if(isset($street_number->long_name))
			$this->address_street_number = $street_number->long_name;
		
		$address_short = $this->searchAddressComponents("route");
		if(isset($address_short->long_name))
			$this->address_short = $address_short->long_name;

		$post_code = $this->searchAddressComponents("postal_code");
		if(isset($post_code->long_name))
			$this->post_code = $post_code->long_name;
			
		$this->lat = $this->response->results[0]->geometry->location->lat;
		$this->lng = $this->response->results[0]->geometry->location->lng;
		$this->location_type = $this->response->results[0]->geometry->location_type;
	}
	
	/**
	 * Clean all variables before starting a search
	 * 
	 */
	private function _clean(){
		$this->response = '';
		$this->country_long = '';
		$this->country_short = '';
		$this->region_long = '';
		$this->region_short = '';
		$this->city = '';
		$this->address = '';
		$this->address_short = '';
		$this->address_street_number = '';
		$this->post_code = '';
		$this->lat = '';
		$this->lng = '';
		$this->location_type = '';
		$this->status = '';
	}
	
	/**
	 * @return the $status
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @param string $status
	 */
	public function setStatus($status) {
		$this->status = $status;
	}


	
}
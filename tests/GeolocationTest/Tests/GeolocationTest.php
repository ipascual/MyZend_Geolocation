<?php

namespace GeolocationTest\Test;

use GeolocationTest\AbstractTestCase;
use Geolocation\Service\GeolocationService;
use Geolocation\Helper\GoogleMapsHelper;

class GeolocationTest extends AbstractTestCase {

	protected function alterConfig(array $config) {
		return $config;
	}

	public function setup() {
		parent::setup();

		$this->geolocationService = new GeolocationService($this->getServiceManager());

		$this->googleMapsHelper = new GoogleMapsHelper($this->getServiceManager());
	}
	

	/**
	 * Lookup geolocation on Google
	 * 
	 * Lookup a location with a string on Google
	 */
	public function testGoogleLookupLocation() {

		$location = "Barcelona, Spain";

		$googleMapsHelper = $this->googleMapsHelper;
		$googleMapsHelper->forwardSearch($location);
		$this->assertEquals($googleMapsHelper->getStatus(), $googleMapsHelper::OK);

		if ($googleMapsHelper->getStatus() == $googleMapsHelper::OK) {
			$geoData = $googleMapsHelper->getGeoData();
			$this->assertEquals("Spain", $geoData["country_name"]);
			$this->assertEquals("ES", $geoData["country_code2"]);
			$this->assertEquals("Barcelona, Spain", $geoData["address"]);
			$this->assertEquals("Barcelona", $geoData["city"]);
			$this->assertEquals("Catalonia", $geoData["region"]);
			$this->assertEquals("41.3850639", $geoData["latitude"]);
			$this->assertEquals("2.1734035", $geoData["longitude"]);
		}
	}
	
	public function testGoogleAPICountryLanguages() {
		$googleMapsHelper = $this->googleMapsHelper;

		$locationEN = "United States";
		$googleMapsHelper->forwardSearch($locationEN);
		$this->assertEquals($googleMapsHelper->getStatus(), $googleMapsHelper::OK);
		if ($googleMapsHelper->getStatus() == $googleMapsHelper::OK) {
			$geoDataEN = $googleMapsHelper->getGeoData();
		}
		
		$locationES = "Estados Unidos";
		$googleMapsHelper->forwardSearch($locationES);
		$this->assertEquals($googleMapsHelper->getStatus(), $googleMapsHelper::OK);
		if ($googleMapsHelper->getStatus() == $googleMapsHelper::OK) {
			$geoDataES = $googleMapsHelper->getGeoData();
		}
		
		$locationFR = "États-Unis";
		$googleMapsHelper->forwardSearch($locationFR);
		$this->assertEquals($googleMapsHelper->getStatus(), $googleMapsHelper::OK);
		if ($googleMapsHelper->getStatus() == $googleMapsHelper::OK) {
			$geoDataFR = $googleMapsHelper->getGeoData();
		}
		
		$locationDE = "Vereinigte Staaten";
		$googleMapsHelper->forwardSearch($locationDE);
		$this->assertEquals($googleMapsHelper->getStatus(), $googleMapsHelper::OK);
		if ($googleMapsHelper->getStatus() == $googleMapsHelper::OK) {
			$geoDataDE = $googleMapsHelper->getGeoData();
		}
		
		$this->assertEquals($geoDataEN["country_name"], $geoDataDE["country_name"]);
		$this->assertEquals($geoDataEN["country_code2"], $geoDataDE["country_code2"]);
		$this->assertEquals($geoDataEN["country_name"], $geoDataES["country_name"]);
		$this->assertEquals($geoDataEN["country_code2"], $geoDataES["country_code2"]);
		$this->assertEquals($geoDataEN["country_name"], $geoDataFR["country_name"]);
		$this->assertEquals($geoDataEN["country_code2"], $geoDataFR["country_code2"]);
		
	}

	/**
	 * Create a geolocation
	 * 
	 * 1) Lookup a location with a string on Google
	 * 2) Creates new Country
	 * 3) Creates new Geolocation
	 *
	 */
	public function testCreate() {

		//Location string
		$location = "24, Marylebone Flyover, London";

		$totalGeolocations = $this->geolocationService->findAll()->count();

		//Lookup Destination on Google
		$googleMapsHelper = $this->googleMapsHelper;
		$googleMapsHelper->forwardSearch($location);
		if ($googleMapsHelper->getStatus() == $googleMapsHelper::OK) {
			$geoData = $googleMapsHelper->getGeoData();
			$geolocation = $this->geolocationService->lookup($geoData);
		}
		
		$this->assertNotNull($geolocation);
		$this->assertCount($totalGeolocations + 1, $this->geolocationService->findAll());

		//Location string
		$location = "37, Marylebone Flyover, London";

		$totalGeolocations = $this->geolocationService->findAll()->count();

		//Lookup Destination on Google
		$googleMapsHelper = $this->googleMapsHelper;
		$googleMapsHelper->forwardSearch($location);
		if ($googleMapsHelper->getStatus() == $googleMapsHelper::OK) {
			$geoData = $googleMapsHelper->getGeoData();
			$geolocation = $this->geolocationService->lookup($geoData);
		}
		
		$this->assertNotNull($geolocation);
		$this->assertCount($totalGeolocations, $this->geolocationService->findAll());

		//Location string
		$location = "cra. 64 38, Medellin";

		$totalGeolocations = $this->geolocationService->findAll()->count();

		//Lookup Destination on Google
		$googleMapsHelper = $this->googleMapsHelper;
		$googleMapsHelper->forwardSearch($location);
		if ($googleMapsHelper->getStatus() == $googleMapsHelper::OK) {
			$geoData = $googleMapsHelper->getGeoData();
			$geolocation = $this->geolocationService->lookup($geoData);
		}

		$this->assertNotNull($geolocation);
		$this->assertCount($totalGeolocations + 1, $this->geolocationService->findAll());

		//Location string
		$location = "20 East 42nd Street, New York, NY, United States";

		$totalGeolocations = $this->geolocationService->findAll()->count();

		//Lookup Destination on Google
		$googleMapsHelper = $this->googleMapsHelper;
		$googleMapsHelper->forwardSearch($location);
		if ($googleMapsHelper->getStatus() == $googleMapsHelper::OK) {
			$geoData = $googleMapsHelper->getGeoData();
			$geolocation = $this->geolocationService->lookup($geoData);
		}

		$this->assertNotNull($geolocation);
		$this->assertCount($totalGeolocations + 1, $this->geolocationService->findAll());

		//Location string
		$location = "20 East 42nd Street, New York, NY, United States";

		$totalGeolocations = $this->geolocationService->findAll()->count();

		//Lookup Destination on Google
		$googleMapsHelper = $this->googleMapsHelper;
		$googleMapsHelper->forwardSearch($location);
		if ($googleMapsHelper->getStatus() == $googleMapsHelper::OK) {
			$geoData = $googleMapsHelper->getGeoData();
			$geolocation = $this->geolocationService->lookup($geoData);
		}

		$this->assertNotNull($geolocation);
		$this->assertCount($totalGeolocations, $this->geolocationService->findAll());
		
	}

	/**
	 * Lookup a geo locaiton on the database
	 * 
	 */
	public function testLookupLocation() {
		$location = "Berlin, Germany";

		$totalGeolocations = $this->geolocationService->findAll()->count();

		//Lookup Destination on Google
		$googleMapsHelper = $this->googleMapsHelper;
		$googleMapsHelper->forwardSearch($location);
		if ($googleMapsHelper->getStatus() == $googleMapsHelper::OK) {
			$geoData = $googleMapsHelper->getGeoData();
			$geolocation = $this->geolocationService->lookup($geoData);
		}

		$this->assertNotNull($geolocation);
		$this->assertCount($totalGeolocations + 1, $this->geolocationService->findAll());
	}

}

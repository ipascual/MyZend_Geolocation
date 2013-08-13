<?php

namespace Geolocation\Service;

use MyZend\Service\Service as Service;
use Geolocation\Helper\GoogleMapsHelper;
use Geolocation\Document\Geolocation;
use Geolocation\Document\Country;
use Geolocation\Document\City;

class GeolocationService extends Service {

	protected $document = "Geolocation\Document\Geolocation";

	public function __construct($sm) {
		$this->dm = $sm->get('doctrine.documentmanager.odm_default');
		$this->googleMapsHelper = new GoogleMapsHelper($sm);
	}

	/**
	 * Look for a Geo Location on the database, if not exists create it.
	 * 
	 */
	public function lookup($geoData) {
		$googleMapsHelper = $this->googleMapsHelper;
		
		$filterCountry = array("code2" => $geoData["country_code2"]);
		$country = $this->findCountry($filterCountry);
		if (!$country) {
			$country = $this->createCountry($geoData);
		}

		$filterCity = array("country.id" => $country->getId(), "name" => $geoData["city"]);
		$city = $this->findCity($filterCity);
		if (!$city) {
			$location = $geoData['city'] . ", " . $country->getName();
			$this->googleMapsHelper->forwardSearch($location);
			if ($googleMapsHelper->getStatus() == $googleMapsHelper::OK) {
				$geoDataCity = $googleMapsHelper->getGeoData();
				$city = $this->createCity($geoDataCity, $country);
			}
			else {
				throw new \Exception("City was not found.");
			}
		}

		$filterGeolocation = array("longitude" => $geoData["longitude"], "latitude" => $geoData["latitude"], "city.id" => $city->getId());
		$geolocation = $this->findGeolocation($filterGeolocation);
		if (!$geolocation) {
			$geolocation = $this->createGeolocation($geoData, $city);
		}

		return $geolocation;
	}

	/**
	 * Find all Country
	 *
	 * @return Document collection 
	 */
	public function findAllCountry() {
		return $this->dm->getRepository("Geolocation\Document\Country")->findAll();
	}

	/**
	 * Create a Country with $geoData array
	 * 
	 * @param Array $geoData All values of the country. "country_name" and "country_code2"
	 */
	public function createCity($geoData, $country) {
		$city = new City();
		$city->setName($geoData['city']);
		$city->setCountry($country);
		$city->setState($geoData['region']);
		$city->setStateShort($geoData['region_short']);
		$city->setLatitude($geoData['latitude']);
		$city->setLongitude($geoData['longitude']);
		
		return $this->save($city);
	}

	/**
	 * Create a Country with $geoData array
	 * 
	 * @param Array $geoData All values of the country. "country_name" and "country_code2"
	 */
	public function createCountry($geoData) {
		$country = new Country();
		$country->setName($geoData["country_name"]);
		$country->setCode2($geoData["country_code2"]);
		return $this->save($country);
	}

	/**
	 * Create a Geolocation with $geoData array
	 * 
	 * @param Array $geoData All values of the Geo Location.
	 * @param Geolocation\Document\Country $country 
	 */
	public function createGeolocation($geoData, City $city) {
		$geolocation = new Geolocation();
		$geolocation->setAddress($geoData["address"]);
		$geolocation->setCity($city);
		$geolocation->setPostCode($geoData["post_code"]);
		$geolocation->setLatitude($geoData["latitude"]);
		$geolocation->setLongitude($geoData["longitude"]);

		return $this->save($geolocation);
	}

	public function findCity(array $data) {
		return $this->dm->getRepository("Geolocation\Document\City")->findOneBy($data);
		
	}

	public function findCountry(array $data) {
		return $this->dm->getRepository("Geolocation\Document\Country")->findOneBy($data);
	}

	public function findGeolocation(array $data) {
		return $this->findOneBy($data);
	}

}
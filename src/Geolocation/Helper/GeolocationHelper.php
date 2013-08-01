<?php
namespace Geolocation\Helper;

use MyZend\Helper\Helper;
use Geolocation\Helper\GoogleMapsHelper;
use Geolocation\Service\GeolocationService;

class GeolocationHelper extends Helper {

	protected $geolocationService;
	protected $googleMapsHelper;

	public function __construct($sm) {
		$this->geolocationService = new GeolocationService($sm);
		$this->googleMapsHelper = new GoogleMapsHelper($sm);
	}

	public function lookupGeolocation($location) {
		$googleMapsHelper = $this->googleMapsHelper;
		$googleMapsHelper->forwardSearch($location);
		if ($this->googleMapsHelper->getStatus() == $googleMapsHelper::OK) {
			$geoData = $googleMapsHelper->getGeoData();
			return $this->geolocationService->lookup($geoData);
		} else {
			return NULL;
		}
	}

}


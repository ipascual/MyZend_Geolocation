<?php

namespace Geolocation\Service;

use MyZend\Service\Service as Service;
use Geolocation\Helper\GoogleMapsHelper;
use Geolocation\Document\Geolocation;
use Geolocation\Document\Country;
use Geolocation\Document\City;

class CityService extends Service {

	protected $document = "Geolocation\Document\City";

	public function __construct($sm) {
		$this->dm = $sm->get('doctrine.documentmanager.odm_default');
	}

	public function findCities(array $data) {
		return $this->dm->getRepository("Geolocation\Document\City")->findBy($data);

	}


}
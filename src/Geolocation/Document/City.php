<?php

namespace Geolocation\Document;

use MyZend\Document\Document as Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document(collection="geolocation_city") */
class City extends Document {

	/** @ODM\Id */
	protected $id;

	/** @ODM\String */
	protected $name;
	
	/** @ODM\String */
	protected $state;
	
	/** @ODM\ReferenceOne(targetDocument="Geolocation\Document\Country") */
	protected $country;

	/** @ODM\Float */
	protected $latitude;

	/** @ODM\Float */
	protected $longitude;

}

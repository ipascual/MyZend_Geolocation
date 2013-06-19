<?php

namespace Geolocation\Document;

use MyZend\Document\Document as Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document(collection="geolocation_geolocation") */
class Geolocation extends Document {

	/** @ODM\Id */
	protected $id;

	/** @ODM\String */
	protected $address;
	
	/** @ODM\String */
	protected $post_code;	
	
	/** @ODM\ReferenceOne(targetDocument="Geolocation\Document\City") */
	protected $city;

	/** @ODM\Float */
	protected $latitude;

	/** @ODM\Float */
	protected $longitude;

}

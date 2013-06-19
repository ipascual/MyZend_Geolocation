<?php

namespace Geolocation\Document;

use MyZend\Document\Document as Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document(collection="geolocation_country") */
class Country extends Document {

	/** @ODM\Id */
	protected $id;

	/** @ODM\String */
	protected $name;

	/** @ODM\String */
	protected $code2;

	/** @ODM\String */
	protected $code3;

}

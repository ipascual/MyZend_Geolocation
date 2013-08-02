MyZend / Geolocation
=======
Version 0.9

Build status:

[![Build Status](https://travis-ci.org/ipascual/MyZend_Geolocation.png?branch=master)](https://travis-ci.org/ipascual/MyZend_Geolocation)


Introduction
------------

MyZend Geolocation is a ZF2 module to resolve an address using Google Maps API.

Uses MongoDB to save the locations.

You could add a reference of this objects from any of your entities.
```
/** @ODM\ReferenceOne(targetDocument="Geolocation\Document\Geolocation") */
protected $geolocation;
```

Examples
------------
```
/**
* Basic usage
*/
$googleMapsHelper = new Geolocation\Document\GoogleMapsHelper($this->getServiceManager());
$googleMapsHelper->forwardSearch("La Rambla, s/n, Barcelona");
if ($googleMapsHelper->getStatus() == $googleMapsHelper::OK) {
	var_dump($googleMapsHelper->getGeoData());
}
```

```
/**
* Document resolve creation
*/
$geolocationHelper = new Geolocation\Document\GeolocationHelper($this->getServiceManager());
$geolocationDocument = $geolocationHelper->lookupGeolocation("Brixton Academy, London");
```

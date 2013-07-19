<?php
$data[] = array(
  "_id" => new MongoId("517edb0f8f604cb90e000001"),
  "name" => "Barcelona",
  "state" => "Catalonia",	
  "country" => array(
    '$ref' => "geolocation_country",
    '$id' => new MongoId("517edb0f8f604cb90e000000"),
	'$db' => $databaseName
  ),
  "latitude" => 41.3850639,
  "longitude" => 2.1734035
);
$data[] = array(
  "_id" => new MongoId("517edb108f604cb90e000004"),
  "name" => "Medellin",
   "state" => "Antioquia",	
  "country" => array(
    '$ref' => "geolocation_country",
    '$id' => new MongoId("517edb108f604cb90e000003"),
    '$db' => $databaseName
  ),
  "latitude" => 6.235925,
  "longitude" => -75.575137
);
$data[] = array(
  "_id" => new MongoId("517edb118f604cb90e000006"),
  "name" => "Montilla",
  "state" => "Andalusia",	
  "country" => array(
    '$ref' => "geolocation_country",
    '$id' => new MongoId("517edb0f8f604cb90e000000"),
    '$db' => $databaseName
  ),
  "latitude" => 37.5868449,
  "longitude" => -4.638967
);
$data[] = array(
  "_id" => new MongoId("517edb118f604cb90e000009"),
  "name" => "New York",
  "State" => "New York",
  "country" => array(
    '$ref' => "geolocation_country",
    '$id' => new MongoId("517edb118f604cb90e000008"),
    '$db' => $databaseName
  ),
  "latitude" => 40.7143528,
  "longitude" => -74.0059731
);

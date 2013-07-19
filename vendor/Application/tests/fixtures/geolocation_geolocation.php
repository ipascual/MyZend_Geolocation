<?php
$data[] = array(
  "_id" => new MongoId("517edb0f8f604cb90e000002"),
  "address" => "La Rambla, 08002 Barcelona, Spain",
  "city" => array(
    '$ref' => "geolocation_city",
    '$id' => new MongoId("517edb0f8f604cb90e000001"),
    '$db' => $databaseName
  ),
  "latitude" => 41.380628,
  "longitude" => 2.1736394
);
$data[] = array(
  "_id" => new MongoId("517edb108f604cb90e000005"),
  "address" => "Calle 64 # 56-15, Medellín, Antioquia, Colombia",
  "city" => array(
    '$ref' => "geolocation_city",
    '$id' => new MongoId("517edb108f604cb90e000004"),
    '$db' => $databaseName
  ),
  "latitude" => 6.2625066,
  "longitude" => -75.5701985
);
$data[] = array(
  "_id" => new MongoId("517edb118f604cb90e000007"),
  "address" => "Avenida de Andalucía, 56, 14550 Montilla, Córdoba, Spain",
  "city" => array(
    '$ref' => "geolocation_city",
    '$id' => new MongoId("517edb118f604cb90e000006"),
    '$db' => $databaseName
  ),
  "latitude" => 37.5812963,
  "longitude" => -4.6462738
);
$data[] = array(
  "_id" => new MongoId("517edb118f604cb90e00000a"),
  "address" => "140-20 15th Avenue, Queens, NY 11356, USA",
  "post_code" => "11356",
  "city" => array(
    '$ref' => "geolocation_city",
    '$id' => new MongoId("517edb118f604cb90e000009"),
    '$db' => $databaseName
  ),
  "latitude" => 40.7846292,
  "longitude" => -73.8285851
);

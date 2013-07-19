<?php
$data[] = array(
  "_id" =>  new MongoId("518547818f604cd30c000004"),
   "name" =>  "Property Lease Report - test1",
   "status" =>  "Pending",
   "owner" =>  array(
     '$ref' =>  "user_user",
     '$id' =>  new MongoId("50c266838f604cbb0a000000"),
     '$db' => $databaseName 
  ),
   "property" =>  array(
     '$ref' =>  "estate_property",
     '$id' =>  new MongoId("517fdf078f604ce416000000"),
     '$db' => $databaseName 
  ),
   "lease" =>  array(
     '$ref' =>  "estate_lease",
     '$id' =>  new MongoId("517e98688f604cba09000000"),
     '$db' => $databaseName 
  ),
  "created_at" => new MongoDate(strtotime("2013-05-04 17:38:09")) 
);

$data[] = array(
  "_id" =>  new MongoId("5186fc808f604c7915000000"),
   "name" =>  "Property Lease Report - test2",
   "status" =>  "Pending",
   "owner" =>  array(
     '$ref' =>  "user_user",
     '$id' =>  new MongoId("50c266838f604cbb0a000000"),
     '$db' => $databaseName 
  ),
   "property" =>  array(
     '$ref' =>  "estate_property",
     '$id' =>  new MongoId("517fdf078f604ce416000000"),
     '$db' => $databaseName 
  ),
   "lease" =>  array(
     '$ref' =>  "estate_lease",
     '$id' =>  new MongoId("5186fc808f604c7915000000"),
     '$db' => $databaseName 
  ),
  "created_at" => new MongoDate(strtotime("2013-05-04 19:15:05")) 
);

$data[] = array(
  "_id" =>  new MongoId("518d93448f604cfb17000000"),
   "name" =>  "Property Lease Report - test3",
   "status" =>  "Pending",
   "owner" =>  array(
     '$ref' =>  "user_user",
     '$id' =>  new MongoId("50c266838f604cbb0a000000"),
     '$db' => $databaseName 
  ),
   "property" =>  array(
     '$ref' =>  "estate_property",
     '$id' =>  new MongoId("517fdf078f604ce416000000"),
     '$db' => $databaseName 
  ),
   "lease" =>  array(
     '$ref' =>  "estate_lease",
     '$id' =>  new MongoId("518d7e8e8f604c5917000000"),
     '$db' => $databaseName 
  ),
  "created_at" => new MongoDate(strtotime("2013-05-04 20:01:11")) 
);

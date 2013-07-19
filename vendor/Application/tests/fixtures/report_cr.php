<?php
$data[] = array(
  "_id" => new MongoId("51940e218f604cc011000000"),
  "created_at" => new MongoDate(strtotime("2013-05-15 22:37:21")),
  "name" => "Comparison Report 1",
   "owner" =>  array(
     '$ref' =>  "user_user",
     '$id' =>  new MongoId("50c266838f604cbb0a000000"),
     '$db' => $databaseName 
  ),
  "plrs" => array(
    array(
		'$ref' => "report_plr",
		'$id' => new MongoId("518547818f604cd30c000004"),
		'$db' => $databaseName 
    ),
    array(
      '$ref' => "report_plr",
      '$id' => new MongoId("5186fc808f604c7915000000"),
     '$db' => $databaseName 
    ),
    array(
      '$ref' => "report_plr",
      '$id' => new MongoId("518d93448f604cfb17000000"),
     '$db' => $databaseName 
    )
  ),
  "status" => "pending"
);

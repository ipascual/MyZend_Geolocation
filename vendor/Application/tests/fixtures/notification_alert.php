<?php 
$data[] = array(
  "_id" => new MongoId("50b788d5724f9a820a000000"),
   "to" => array(
     '$ref' => "user_user",
     '$id' => new MongoId("50116a08724f9a2a0a000000"),
     '$d' => $databaseName 
  	),
   "content" => "Welcome abroad.",
   "link" => "\/user\/profile\/myaccount",
   "status" => "unread",
   "timestamp" => new MongoDate(strtotime("2012-11-29 16:09:57")) 
  );


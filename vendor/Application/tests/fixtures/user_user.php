<?php 
$data[] = array(
  "_id"  => new MongoId("50116983724f9a280a000000"),
  "about_me" => "la la la la la .....la la la la",
  "addresses" => array(array(
	    "street" => "555 Doctrine Rd.",
		"city"=> array(
			'$ref'=> "geolocation_geolocation",
			'$id'=> new MongoId("50293312724f9ab00c000000"),
			'$db'=> $databaseName
		),
	    "postal_code" => "37209"
	),
  ),
  "created_at" => new MongoDate(strtotime("2012-07-26 09:51:33")),
  "birthday" => Date('1988-05-14'),
  "email" => "rebecap@fincaelmanantial.com",
  "facebook" => array(
    "email" => "rebecap@facebook.com",
    "username" => "rebecap"
  ),
  "full_name" => "Rebeca Pascual",
  "gender" => "female",
  "locale" => "en_US",
  "password" => "54321",
  "phonenumbers" => array(
    array(
      "phonenumbers" => "689654578"
    ),
  ),
  "picture" => array(
    "_id" => new MongoId("50116984724f9a280a000002"),
    "picture" => "rebecoida.jpg",
    "label" => "Mi jeto"
  ),
  "updated_at" => new MongoDate(strtotime("2012-07-26 15:34:20")),
  "validation" => array(
    "email" => array(
      "code" => "11111111111111111",
      "mode" => "email",
      "try" => 1,
      "validated_at" => new MongoDate(strtotime("2012-07-26 15:34:20"))
    )
  )
);

$data[] = array(
  "_id" => new MongoId("50116a08724f9a2a0a000000"),
  "addresses" => array(array(
	    "street" => "172 Leander Road",
		"city"=> array(
			'$ref'=> "geolocation_geolocation",
			'$id'=> new MongoId("50293323724f9ab90c000000"),
			'$db'=> $databaseName
		),
	    "postal_code" => "SW2 2LE"
	),
  ),
  "created_at" => new MongoDate(strtotime("2012-07-28 13:12:45")),
  "email" => "cmontoya@example.com",
  "password" => "54321",
  "facebook" => array(
    "email" => "caromm@facebook.com",
    "username" => "caroline"
  ),
  "full_name" => "Caroline Montoya",
  "gender" => "female",
  "locale" => "en_US",
  "phonenumbers" => array(
    array(
      "phonenumbers" => "3220000000"
    )
  ),
  "picture" => array(
    "_id" => new MongoId("50116984724f9a280a000002"),
    "picture" => "caroline.jpg",
    "label" => "This is me"
  ),
  "alerts" => array(
		"50b7bd3e69ff7" => array(
		   "content" => "First alert",
		   "link" => "\/user\/profile\/myaccount1",
		   "status" => "unread",
		   "timestamp" => new MongoDate(strtotime("2012-11-28 11:00:00"))
   		),
		"50b7bd5e383f6" => array(
		   "content" => "Second alert",
		   "link" => "\/user\/profile\/myaccount2",
		   "status" => "unread",
		   "timestamp" => new MongoDate(strtotime("2012-11-28 16:00:00"))
   		),
 		"50b7bd64f25df" => array(
		   "content" => "Third Alert",
		   "link" => "\/user\/profile\/myaccount3",
		   "status" => "unread",
		   "timestamp" => new MongoDate(strtotime("2012-11-28 21:00:00"))
   		) 
  ),
);

$data[] = array(
  "_id"  => new MongoId("50c2668f8f604cbf0a000000"),
  "addresses" => array(array(
	    "street" => "Cra 66 12 34",
		"city"=> array(
			'$ref'=> "geolocation_geolocation",
			'$id'=> new MongoId("50293301724f9aaa0c000001"),
			'$db'=> $databaseName
		),
	    "postal_code" => "n/a"
	),
  ),
  "created_at" => new MongoDate(strtotime("2012-12-10 17:33:13")),
  "email" => "linammc@hotmail.com",
  "facebook" => array(
    "email" => "linammc@hotmail.com",
    "username" => "linammc3"
  ),
  "full_name" => "Lina M. Montoya",
  "gender" => "female",
  "locale" => "es_CO",
  "phonenumbers" => array(
    array(
      "phonenumbers" => "31033344455"
    ),
  ),
  "validation" => array(
    "email" => array(
      "code" => "22222222",
      "mode" => "email",
      "try" => 1,
      "validated_at" => new MongoDate(strtotime("2012-12-10 17:39:42"))
    )
  )
);

$data[] = array(
  "_id"  => new MongoId("50c266838f604cbb0a000000"),
  "addresses" => array(array(
    "street" => "Castillejos 343, 34 5 piso 8a",
	"city"=> array(
		'$ref'=> "geolocation_geolocation",
		'$id'=> new MongoId("517edb0f8f604cb90e000002"),
		'$db'=> $databaseName
	),
	"postal_code" => "80025"
	),
  ),
  "created_at" => new MongoDate(strtotime("2012-12-11 14:05:59")),
  "email" => "ignacio@bcn.com",
  "role" => "user",
  "facebook" => array(
    "email" => "ignacio@bcn.com",
    "username" => "ilovebcn"
  ),
  "full_name" => "Ignacio Pascual ",
  "gender" => "male",
  "locale" => "es_ES",
  "phonenumbers" => array(
    array(
      "phonenumbers" => "003465944321233"
    ),
  ),
  "validation" => array(
    "email" => array(
      "code" => "333333333",
      "mode" => "email",
      "try" => 1,
      "validated_at" => new MongoDate(strtotime("2012-12-11 14:09:34"))
    )
  )
);

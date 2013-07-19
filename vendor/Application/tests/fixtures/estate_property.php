<?php
$data[] = array(
	"_id" => new MongoId("517fdf078f604ce416000000"),
	"owner" => array(
		 '$ref' => "user_user",
		 '$id' => new MongoId("50c266838f604cbb0a000000"),
		 '$db' => $databaseName
	  ),
	   "building_name" => "NewY Google Offices",
	   "building_type" => "commercial",
	   "building_grade" => "premium",
	   "address" => "1st. floor. 220 George Street",
	   "post_code" => "11200",
	   "geolocation" => array(
		 '$ref' => "geolocation_geolocation",
		 '$id' => new MongoId("517edb118f604cb90e00000a"),
		 '$db' => $databaseName
	),
	"agency" => array(
	 "agent_full_name" => "John Smith",
	 "name" => "Leasing Agent Pty Ltd.",
	 "email" => "jsmith@acmelease.com",
	 "phone" => "+1 (212) 335444",
	 "address" => "223, Main Street",
	 "post_code" => "11201",
	 "geolocation" => array(
	   '$ref' => "geolocation_geolocation",
	   '$id' => new MongoId("517edb118f604cb90e00000a"),
	   '$db' => $databaseName
	) 
	)
);
  
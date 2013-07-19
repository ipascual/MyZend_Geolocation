<?php
$data[] = array(
  "_id" =>  new MongoId("517e98688f604cba09000000"),
  "owner" => array(
	 '$ref' => "user_user",
	 '$id' => new MongoId("50c266838f604cbb0a000000"),
	 '$db' => $databaseName
  ),
  "area" =>  56,
  "commencing_base_rental" =>  500,
  "costs" =>  array(
    array(
      "label" =>  "Advisory Fees",
      "amount" =>  10000
    ),
    array(
      "label" =>  "Legal Fees",
      "amount" =>  12500
    ),
    array(
      "label" =>  "Relocation Costs",
      "amount" =>  25000
    ),
    array(
      "label" =>  "Other Fees",
      "amount" =>  5000
    )
  ),
  "direct_recoveries" =>  0,
  "expense_growth_assumption" =>  3,
  "incentives" =>  array(
    array(
      "type" =>  "abatement",
      "label" =>  "Rental Abatement",
      "start_date" =>  new MongoDate(strtotime("2013-05-01 00:00:00")),
      "end_date" =>  new MongoDate(strtotime("2013-10-31 00:00:00")),
      "charge_type" => "amount",
      "amount" =>  150
    ),
    array(
      "type" =>  "cash",
      "label" =>  "Cash Contribution",
      "start_date" =>  new MongoDate(strtotime("2013-10-01 00:00:00")),
      "amount" =>  10000
    ),
    array(
      "type" =>  "rent_free",
      "label" =>  "Rent Free",
      "start_date" =>  new MongoDate(strtotime("2013-05-01 00:00:00")),
      "amount" =>  6
    )
  ),
  "lease_commencement_date" =>  new MongoDate(strtotime("2013-10-01 00:00:00")),
  "lease_term" => 120,
  "other_charges" =>  array(
    array(
      "label" =>  "Parking",
      "number" =>  1,
      "amount" =>  450,
      "rental_review" =>  array(
        "frequency" =>  0,
        "type" =>  "fixed",
        "amount" =>  4,
        "margin" =>  0
      )
    ),
    array(
      "label" =>  "Other",
      "number" =>  1,
      "amount" =>  41.67,
      "rental_review" =>  array(
        "frequency" =>  0,
        "type" =>  "fixed",
        "amount" =>  4,
        "margin" =>  0
      )
    )
  ),
  "outgoings" =>  0,
  "property_outgoings" =>  100,
  "premises" =>  "Level 6 Suite 1",
  "recovery_type" =>  "gross",
  "rental_review" =>  array(
    "frequency" =>  12,
    "type" =>  "fixed",
    "amount" =>  4,
    "margin" =>  0
  ),
  "wacc" =>  10
);


$data[] = array(
  "_id" =>  new MongoId("5186fc808f604c7915000000"),
  "owner" => array(
	 '$ref' => "user_user",
	 '$id' => new MongoId("50c266838f604cbb0a000000"),
	 '$db' => $databaseName
  ),
  "area" =>  78,
  "commencing_base_rental" =>  450,
  "costs" =>  array(
    array(
      "label" =>  "Legal Fees",
      "amount" =>  9800
    ),
  ),
  "direct_recoveries" =>  0,
  "expense_growth_assumption" =>  3.5,
  "incentives" =>  array(
    array(
      "type" =>  "cash",
      "label" =>  "Cash Contribution",
      "start_date" =>  new MongoDate(strtotime("2013-10-01 00:00:00")),
      "amount" =>  7500
    )
  ),
  "lease_commencement_date" =>  new MongoDate(strtotime("2013-10-01 00:00:00")),
  "lease_term" => 60,
  "other_charges" =>  array(
    array(
      "label" =>  "Parking",
      "number" =>  1,
      "amount" =>  358,
      "rental_review" =>  array(
        "frequency" =>  0,
        "type" =>  "fixed",
        "amount" =>  3.5,
        "margin" =>  0
      )
    )
  ),
  "outgoings" =>  0,
  "property_outgoings" =>  0,
  "premises" =>  "Level 9 Suite 2",
  "recovery_type" =>  "gross",
  "rental_review" =>  array(
    "frequency" =>  24,
    "type" =>  "fixed",
    "amount" =>  4,
    "margin" =>  0
  ),
  "wacc" =>  10
);

$data[] = array(
  "_id" =>  new MongoId("518d7e8e8f604c5917000000"),
  "owner" => array(
	 '$ref' => "user_user",
	 '$id' => new MongoId("50c266838f604cbb0a000000"),
	 '$db' => $databaseName
  ),
  "area" =>  67,
  "commencing_base_rental" =>  550,
  "costs" =>  array(
    array(
      "label" =>  "Advisory Fees",
      "amount" =>  9850
    ),
    array(
      "label" =>  "Legal Fees",
      "amount" =>  11200
    )
  ),
  "direct_recoveries" =>  1.5,
  "expense_growth_assumption" =>  2.9,
  "incentives" =>  array(
    array(
      "type" =>  "abatement",
      "label" =>  "Rental Abatement",
      "start_date" =>  new MongoDate(strtotime("2013-05-01 00:00:00")),
      "end_date" =>  new MongoDate(strtotime("2013-10-31 00:00:00")),
      "charge_type" => "percentage",
      "amount" =>  3
    )
  ),
  "lease_commencement_date" =>  new MongoDate(strtotime("2013-10-01 00:00:00")),
  "lease_term" => 240,
  "outgoings" =>  0,
  "property_outgoings" =>  0,
  "premises" =>  "Level 1 Suite 34",
  "recovery_type" =>  "gross",
  "rental_review" =>  array(
    "frequency" =>  12,
    "type" =>  "fixed",
    "amount" =>  3.6,
    "margin" =>  0
  ),
  "wacc" =>  10
);

$data[] = array(
  "_id" =>  new MongoId("51940e218f604cc011000000"),
  "owner" => array(
	 '$ref' => "user_user",
	 '$id' => new MongoId("50c266838f604cbb0a000000"),
	 '$db' => $databaseName
  ),
  "area" =>  1,
  "commencing_base_rental" =>  500,
  "direct_recoveries" =>  0,
  "expense_growth_assumption" =>  0,
  "lease_commencement_date" =>  new MongoDate(strtotime("2013-10-01 00:00:00")),
  "lease_term" => 60,
  "outgoings" =>  0,
  "property_outgoings" =>  100,
  "premises" =>  "Level 6 Suite 1",
  "recovery_type" =>  "gross",
  "rental_review" =>  array(
    "frequency" =>  12,
    "type" =>  "fixed",
    "amount" =>  4,
    "margin" =>  0
  ),
  "wacc" =>  10
);

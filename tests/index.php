<?php
$command = "phpunit";
//$command = "phpunit --filter UserServiceTest";
//$command = "phpunit --filter UserTest::testUserChangeAddress";
//$command = "phpunit --filter UserTest::testUserChangeAddress --debug";
//$command = "phpunit --filter UserTest::testUserChangeAddress --debug";

echo "<h1> $command </h1>";
echo "<pre>";
system($command);
echo "</pre>";

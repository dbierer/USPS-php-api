<?php
// USAGE: citystatelookup.php USPS_USER [USPS_PASSWORD]
// NOTE:  Be sure to run composer dump-autoload to update autoload file mapping
require __DIR__ . '/../vendor/autoload.php';
use USPS\USPSCityStateLookup;

// Initiate and set the username provided from usps
$user   = $argv[1] ?? $_GET['user'] ?? 'xxx';
$pass   = $argv[2] ?? $_GET['password'] ?? '';
$verify = new USPSCityStateLookup($user, $pass);

// During test mode this seems not to always work as expected
$verify->setTestMode(true);

// Add the zip code we want to lookup the city and state
$verify->addZipCode('91730');

// Perform the call and print out the results
print_r($verify->lookup());
print_r($verify->getArrayResponse());

// Check if it was completed
if($verify->isSuccess()) {
  echo 'Done';
} else {
  echo 'Error: ' . $verify->getErrorMessage();
}

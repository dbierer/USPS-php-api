<?php
// USAGE: servicedeliverycalculator.php USPS_USER USPS_PASSWORD
// NOTE:  Be sure to run composer dump-autoload to update autoload file mapping
require __DIR__ . '/../vendor/autoload.php';
use USPS\USPSServiceDeliveryCalculator;

// Initiate and set the username provided from usps
$user   = $argv[1] ?? $_GET['user'] ?? 'xxx';
$pass   = $argv[2] ?? $_GET['password'] ?? '';
$delivery = new USPSServiceDeliveryCalculator($user, $pass);

// During test mode this seems not to always work as expected
$delivery->setTestMode(true);

// Add the zip code we want to lookup the city and state
$delivery->addRoute(3, '91730', '90025');

// Perform the call and print out the results
var_dump($delivery->getServiceDeliveryCalculation());
var_dump($delivery->getArrayResponse());


// Check if it was completed
if($delivery->isSuccess()) {
  echo 'Done';
} else {
  echo 'Error: ' . $delivery->getErrorMessage();
}

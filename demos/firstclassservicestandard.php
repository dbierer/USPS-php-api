<?php
// USAGE: firstclassservicestandard.php USPS_USER
// NOTE:  Be sure to run composer dump-autoload to update autoload file mapping
require __DIR__ . '/../vendor/autoload.php';
use USPS\USPSFirstClassServiceStandards;

// Initiate and set the username provided from usps.
$user   = $argv[1] ?? $_GET['user'] ?? 'xxx';
$delivery = new USPSFirstClassServiceStandards($user);

// During test mode this seems not to always work as expected.
$delivery->setTestMode(true);

// Add the zip codes we want to know a shipping time between.
$delivery->addRoute('91730', '90025');

// Perform the call and print out the results.
var_dump($delivery->getServiceStandard());
var_dump($delivery->getArrayResponse());

// Check if it was completed
if($delivery->isSuccess()) {
  echo 'Done';
} else {
  echo 'Error: ' . $delivery->getErrorMessage();
}

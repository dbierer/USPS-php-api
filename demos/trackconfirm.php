<?php
// USAGE: trackconfirm.php USPS_USER USPS_PASSWORD
// NOTE:  Be sure to run composer dump-autoload to update autoload file mapping
require __DIR__ . '/../vendor/autoload.php';
use USPS\USPSTrackConfirm;

// Initiate and set the username provided from usps
$user   = $argv[1] ?? $_GET['user'] ?? 'xxx';
$pass   = $argv[2] ?? $_GET['password'] ?? '';
$tracking = new USPSTrackConfirm($user, $pass);

// During test mode this seems not to always work as expected
$tracking->setTestMode(true);

// Add the test package id to the trackconfirm lookup class
$tracking->addPackage("EJ958083578US");

// Perform the call and print out the results
print_r($tracking->getTracking());
print_r($tracking->getArrayResponse());

// Check if it was completed
if($tracking->isSuccess()) {
  echo 'Done';
} else {
  echo 'Error: ' . $tracking->getErrorMessage();
}

?>

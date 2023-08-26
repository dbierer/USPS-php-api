<?php
// USAGE: zipcodelookup.php USPS_USER [USPS_PASSWORD]
// NOTE:  Be sure to run composer dump-autoload to update autoload file mapping
require __DIR__ . '/../vendor/autoload.php';
use USPS\{USPSZipCodeLookup,USPSAddress};

// Initiate and set the username provided from usps
$user   = $argv[1] ?? $_GET['user'] ?? 'xxx';
$pass   = $argv[2] ?? $_GET['password'] ?? '';
$zipcode = new USPSZipCodeLookup($user, $pass);

// During test mode this seems not to always work as expected
$zipcode->setTestMode(true);

// Create new address object and assign the properties
// apartently the order you assign them is important so make sure
// to set them as the example below
$address = new USPSAddress;
$address->setFirmName('Apartment');
$address->setApt('100');
$address->setAddress('9200 Milliken Ave');
$address->setCity('Rancho Cucomonga');
$address->setState('CA');

// Add the address object to the zipcode lookup class
$zipcode->addAddress($address);

// Perform the call and print out the results
print_r($zipcode->lookup());
print_r($zipcode->getArrayResponse());

// Check if it was completed
if($zipcode->isSuccess()) {
  echo 'Done';
} else {
  echo 'Error: ' . $zipcode->getErrorMessage();
}

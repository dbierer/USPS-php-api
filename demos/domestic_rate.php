<?php
// Load the class; use Composer autoloader
// NOTE:  Be sure to run composer dump-autoload to update autoload file mapping
require __DIR__ . '/../vendor/autoload.php';
use USPS\{USPSRate,USPSRatePackage};

// Initiate and set the username provided from usps
$rate = new USPSRate('xxxx');

// During test mode this seems not to always work as expected
$rate->setTestMode(true);

// Create new package object and assign the properties
// apartently the order you assign them is important so make sure
// to set them as the example below
// set the USPSRatePackage for more info about the constants
$package = new USPSRatePackage;
$package->setService(USPSRatePackage::SERVICE_FIRST_CLASS);
$package->setFirstClassMailType(USPSRatePackage::MAIL_TYPE_LETTER);
$package->setZipOrigination(91601);
$package->setZipDestination(91730);
$package->setPounds(0);
$package->setOunces(3.5);
$package->setContainer('');
$package->setSize(USPSRatePackage::SIZE_REGULAR);
$package->setField('Machinable', true);

// add the package to the rate stack
$rate->addPackage($package);

// Perform the request and print out the result
print_r($rate->getRate());
print_r($rate->getArrayResponse());

// Was the call successful
if($rate->isSuccess()) {
  echo 'Done';
} else {
  echo 'Error: ' . $rate->getErrorMessage();
}

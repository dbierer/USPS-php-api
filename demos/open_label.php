<?php
// USAGE: open_label.php USPS_USER USPS_PASSWORD
// NOTE: APIs that return printed labels or barcodes become available after applying for advanced permissions from the USPS APIs Functional Team.
//       Be sure to run composer dump-autoload to update autoload file mapping
require __DIR__ . '/../vendor/autoload.php';
use USPS\USPSOpenDistributeLabel;

// Initiate and set the username provided from usps
$user   = $argv[1] ?? $_GET['user'] ?? 'xxx';
$pass   = $argv[2] ?? $_GET['password'] ?? '';
$label = new USPSOpenDistributeLabel($user, $pass);

// During test mode this seems not to always work as expected
$label->setTestMode(true);

$label->setFromAddress('John', 'Doe', '', '5161 Lankershim Blvd', 'North Hollywood', 'CA', '91601', '# 204');
$label->setToAddress('Vincent Gabriel', '5440 Tujunga Ave', 'North Hollywood', 'CA', '91601', '707');
$label->setWeightOunces(1);

// Perform the request and return result
$label->createLabel();

//print_r($label->getArrayResponse());
print_r($label->getPostData());
//var_dump($label->isError());

// See if it was successful
if($label->isSuccess()) {
  echo 'Done';
  echo "\n Confirmation:" . $label->getConfirmationNumber();

  $label = $label->getLabelContents();
  if($label) {
  	 $contents = base64_decode($label);
  	 header('Content-type: application/pdf');
	   header('Content-Disposition: inline; filename="label.pdf"');
	   header('Content-Transfer-Encoding: binary');
	   header('Content-Length: ' . strlen($contents));
	   echo $contents;
	   exit;
  }

} else {
  echo 'Error: ' . $label->getErrorMessage();
}

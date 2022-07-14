<?php 

namespace BurroughsTest;

require_once __DIR__ . '/../vendor/autoload.php';

// Get options from the command line.
$option = getopt('o:');

//get the starting date, which is current month.
$startDate = strtotime("first day of this month");

//get the end date, which is the 12th month from now
$endDate = strtotime("+11 months", $startDate);

//get the file name and check if filename was provided
if (strlen($option["o"]) > 0 and array_key_exists("o", $option)){
  $fileName = $option["o"];
}

// Generate a list of payment dates 
$payroll = new Payroll();
$paydates = $payroll->generateDate($startDate, $endDate);

// Generate csv file with salary and bonus date
$CsvFileCreator = new CsvFileCreator();
$CsvFileCreator->generateFile($paydates, $fileName);

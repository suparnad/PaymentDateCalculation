<?php 
namespace BurroughsTest;

/**
 * Class CsvCreator create a csv file with a calculation result into it.
 *
 * @package BurroughsTest
 */
class CsvFileCreator {

  public function checkFileName($fileName) {

    //check file extension is .csv or not
    if(substr($fileName, -4) !== ".csv") {
			$fileName .= ".csv";
		}
		return $fileName;
  }

  public static function getCsvHeader(){
    return ['Month Name', 'Salary Payment Date', 'Bonus Payment Date'];
  }

  public function getCsvFields(array $paydates) {
			
			foreach($paydates as $i => $dateFormat) {
				$paydates[$i]["date"] = date("F", $paydates[$i]["date"]);
				$paydates[$i]["salaryD"] = date("d/m/Y", $paydates[$i]["salaryD"]);
				$paydates[$i]["bonusD"] = date("d/m/Y", $paydates[$i]["bonusD"]);
			}
			return $paydates;
		}
  
  /** 
  * generate a csv file.
  **/
  public function generateFile($paydates, $fileName){

    $getCsvFields = $this->getCsvFields($paydates);
    $csvFileName = $this->checkFileName($fileName);

    //Opening a file using fopen(). 
    $file = fopen($csvFileName, 'w');

    // Check if we were able to open the file.
    if ($file) {
      fputcsv($file, self::getCsvHeader());
      foreach ($getCsvFields as $i => $getCsvField) {
        fputcsv($file, $getCsvField);
      }
      fclose($file);
    }
  }
}

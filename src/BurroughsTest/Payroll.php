<?php

namespace BurroughsTest;

class Payroll
{

  /**
   * Calculates salary dates for the next 12 months
   */
  public function getSalaryPaymentDate($month)
  {

    $lastDay = strtotime("last day of this month", $month);

    //Convert lastdate into the ISO-8601 numeric representation of a day and check if the last day is a weekend or not. if the last day is a weekend then find the previous Friday
    if ((int)date("N", $lastDay) >= 6) {
      $lastDay = strtotime("last friday", $lastDay);
    }
    return $lastDay;
  }

  /**
   * Calculates bonus dates for the next 12 months
   */
  public function getBonusPaymentDate($month)
  {
    //$nextMonth = strtotime('next month', $month);
    $bonusDay = strtotime(date("15 M Y", $month));

    // If 15th is a weekend. In that case, pay the first Wednesday after the 15th.
    if ((int)date("N", $bonusDay) >= 6) {
      $bonusDay = strtotime("next wednesday", $bonusDay);
    }

    return $bonusDay;
  }

  /**
   * Generate salary payment and bonus dates for the next 12 months
   */
  public function generateDate($startDate, $endDate)
  {
    $currentMonth = $startDate;
    $dates = array();

    while ($currentMonth <= $endDate) {
      $dates[] = array(
        "date" => $currentMonth,
        "salaryD" => $this->getSalaryPaymentDate($currentMonth),
        "bonusD" => $this->getBonusPaymentDate($currentMonth)
      );

      // Next month
      $currentMonth = strtotime("+1 month", $currentMonth);
    }

    return $dates;
  }
}

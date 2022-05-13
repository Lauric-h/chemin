<?php

namespace App\Service;

class WeeksBetweenDatesCalculator
{
    public function calculateWeeksBetweenDates(\DateTimeInterface $startDate, \DateTimeInterface $endDate): int {
        if ($startDate > $endDate) {
            return $this->calculateWeeksBetweenDates($endDate, $startDate);
        }
        return round($startDate->diff($endDate)->days/7);
    }
}

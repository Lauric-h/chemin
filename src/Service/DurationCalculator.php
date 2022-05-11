<?php

namespace App\Service;

class DurationCalculator
{
    public function calculateDuration(\DateTimeInterface $startDate, \DateTimeInterface $endDate): int {
        if ($startDate > $endDate) {
            return $this->calculateDuration($endDate, $startDate);
        }
        return round($startDate->diff($endDate)->days/7);
    }
}

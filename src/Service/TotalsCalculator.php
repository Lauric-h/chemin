<?php

namespace App\Service;

use App\Entity\MainSport;
use App\Entity\SportSession;

class TotalsCalculator
{
    public function setTotals(
        SportSession $sportSession,
        MainSport $mainSport
    ): SportSession
    {
        $sportSession
            ->setTotalDuration($sportSession->getTotalDuration() + $mainSport->getDuration())
            ->setTotalDistance($sportSession->getTotalDistance() + $mainSport->getDistance())
            ->setTotalElevationLoss($sportSession->getTotalElevationLoss() + $mainSport->getElevationLoss())
            ->setTotalElevationGain($sportSession->getTotalElevationGain() + $mainSport->getElevationGain())
        ;

        return $sportSession;
    }
}

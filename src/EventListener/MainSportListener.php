<?php

namespace App\EventListener;

use App\Entity\MainSport;
use App\Service\TotalsCalculator;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class MainSportListener
{
    public function postPersist(
        MainSport $mainSport,
        LifecycleEventArgs $args,
    ): void
    {
        $sportSession = $mainSport->getSportSession();

        $totalsCalculator = new TotalsCalculator();
        $sportSession = $totalsCalculator->setTotals($sportSession, $mainSport);

        $manager = $args->getObjectManager();
        $manager->persist($sportSession);
        $manager->flush();
    }
}

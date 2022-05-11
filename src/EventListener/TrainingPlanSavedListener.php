<?php

namespace App\EventListener;
use App\Entity\TrainingPlan;
use App\Service\DurationCalculator;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class TrainingPlanSavedListener
{
    public function prePersist(
        TrainingPlan $trainingPlan,
        LifecycleEventArgs $args): void
    {

        $durationCalculator = new DurationCalculator();

        $duration = $durationCalculator->calculateDuration(
            $trainingPlan->getStartDate(),
            $trainingPlan->getEndDate());
        $trainingPlan->setDuration($duration);
    }
}

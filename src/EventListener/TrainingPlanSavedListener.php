<?php

namespace App\EventListener;
use App\Entity\TrainingPlan;
use App\Service\WeeksBetweenDatesCalculator;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class TrainingPlanSavedListener
{
    public function prePersist(
        TrainingPlan $trainingPlan,
        LifecycleEventArgs $args,
    ): void
    {
        $weeksBetweenDatesCalculator = new WeeksBetweenDatesCalculator();

        $weeksBetweenDates = $weeksBetweenDatesCalculator->calculateWeeksBetweenDates(
            $trainingPlan->getStartDate(),
            $trainingPlan->getEndDate());
        $trainingPlan->setDuration($weeksBetweenDates);
    }
}

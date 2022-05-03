<?php

namespace App\DataFixtures;

use App\Entity\Enum\MainType;
use App\Entity\Enum\SecondaryType;
use App\Entity\Enum\Tag;
use App\Entity\MainSport;
use App\Entity\SecondarySport;
use App\Entity\SportSession;
use App\Entity\TrainingPlan;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Create 2 training plans
        for ($i = 0; $i < 2; $i++) {
            $trainingPlan = new TrainingPlan();
            $trainingPlan->setName($faker->word(10))
                ->setDuration($faker->randomDigit())
                ->setStartDate($faker->dateTime())
                ->setEndDate($faker->dateTime());

            $manager->persist($trainingPlan);
        }

        // One more training plan to act as the main one
        $trainingPlan = new TrainingPlan();
        $trainingPlan->setName($faker->word(10))
            ->setDuration($faker->randomDigit())
            ->setStartDate($faker->dateTime())
            ->setEndDate($faker->dateTime());

        $manager->persist($trainingPlan);

        for ($i = 0; $i < 5; $i++) {
            $mainSport = new MainSport();
            $mainSport->setDistance($faker->randomDigit())
                ->setElevationGain($faker->randomDigit())
                ->setElevationLoss($faker->randomDigit())
                ->setLocation($faker->words(1, true))
                ->setDuration($faker->randomDigit())
                ->setType(MainType::RUN)
                ->setTag(Tag::SL)
                ->setName($faker->text(100));
            $manager->persist($mainSport);

            $secondarySport = new SecondarySport();
            $secondarySport->setDuration($faker->randomDigit())
                ->setName($faker->words(5, true))
                ->setType(SecondaryType::STRENGTH);
            $manager->persist($secondarySport);

            $warmup = new SecondarySport();
            $warmup->setDuration($faker->randomDigit())
                ->setName($faker->words(5, true))
                ->setType(SecondaryType::WARMUP);
            $manager->persist($warmup);

            $sportSession = new SportSession();
            $sportSession->addMainSport($mainSport)
                ->addSecondarySport($warmup)
                ->addSecondarySport($secondarySport)
                ->setDate($faker->dateTime())
                ->setNotes($faker->words(5, true))
                ->setTrainingPlan($trainingPlan)
                ->setTotalDistance($faker->randomDigit())
                ->setTotalDuration($warmup->getDuration() + $secondarySport->getDuration() + $mainSport->getDuration())
                ->setTotalElevationGain($faker->randomDigit())
                ->setTotalElevationLoss($faker->randomDigit());

            $manager->persist($sportSession);
        }

        $manager->flush();
    }
}

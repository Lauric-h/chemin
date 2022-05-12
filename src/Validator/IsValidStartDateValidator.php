<?php

namespace App\Validator;

use App\Entity\TrainingPlan;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsValidStartDateValidator extends ConstraintValidator
{

    /**
     * @inheritDoc
     */
    public function validate(mixed $trainingPlan, Constraint $constraint)
    {
        if ($trainingPlan->getStartDate() >= $trainingPlan->getEndDate()) {
            $this->context->buildViolation($constraint->message)
                ->atPath('startDate')
                ->addViolation();
        }
    }
}

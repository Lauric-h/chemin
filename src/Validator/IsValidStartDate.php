<?php

namespace App\Validator;
use Symfony\Component\Validator\Constraint;

#[\Attribute]
class IsValidStartDate extends Constraint
{
    public string $message = 'The start date must be before the end date';

    // Mandatory to use class-wide
    // See doc
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}

<?php

namespace App\Entity\Enum;

enum Status: string
{
    case PLANNED = "Planned";
    case DONE = "Done";
    case NOT_DONE = "Not done";
    case IN_PROGRESS = "In progress";
}

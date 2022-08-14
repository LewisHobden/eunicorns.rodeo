<?php

namespace App\Enum;

enum EventTypeEnum: string
{
    case ARGOS = "argos";
    case KAKUL_SATON = "kakul-saton";
    case VALTAN = "valtan";
    case VYKAS = "vykas";
    case OTHER = "other";

    use ToFriendlyTrait;
}

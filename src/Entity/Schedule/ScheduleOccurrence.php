<?php

namespace App\Entity\Schedule;

use App\Entity\Course\CourseClassType;
use DateTime;

class ScheduleOccurrence {
    private string $name;
    private CourseClassType $type;
    private ?string $title;
    private DateTime $start;
    private DateTime $end;
}

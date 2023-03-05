<?php

namespace App\Entity;

use DateTime;

class ScheduleOccurrence {
    private string $name;
    private CourseClassType $type;
    private ?string $title;
    private DateTime $start;
    private DateTime $end;


}

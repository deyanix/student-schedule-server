<?php

namespace App\Entity\Calendar;

use Carbon\Carbon;

enum CalendarWeekDay: int {
	case MONDAY = Carbon::MONDAY;
	case TUESDAY = Carbon::TUESDAY;
	case WEDNESDAY = Carbon::WEDNESDAY;
	case THURSDAY = Carbon::THURSDAY;
	case FRIDAY = Carbon::FRIDAY;
	case SATURDAY = Carbon::SATURDAY;
	case SUNDAY = Carbon::SUNDAY;
}

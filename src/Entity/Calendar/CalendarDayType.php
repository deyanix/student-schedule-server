<?php

namespace App\Entity\Calendar;

enum CalendarDayType {
	case ODD;
	case EVEN;
	case ODD_EVEN;

	public function opposite(): CalendarDayType {
		return match ($this) {
			self::ODD => self::EVEN,
			self::EVEN => self::ODD,
			self::ODD_EVEN => self::ODD_EVEN,
		};
	}
}

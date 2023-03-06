<?php

namespace App\Entity\Calendar;

enum CalendarDayType: string {
	case ODD = 'odd';
	case EVEN = 'even';
	case ODD_EVEN = 'odd_even';

	public function opposite(): CalendarDayType {
		return match ($this) {
			self::ODD => self::EVEN,
			self::EVEN => self::ODD,
			self::ODD_EVEN => self::ODD_EVEN,
		};
	}
}

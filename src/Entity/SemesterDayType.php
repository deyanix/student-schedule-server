<?php

namespace App\Entity;

enum SemesterDayType {
	case ODD;
	case EVEN;
	case ODD_EVEN;

	public function opposite(): SemesterDayType {
		return match ($this) {
			self::ODD => self::EVEN,
			self::EVEN => self::ODD,
			self::ODD_EVEN => self::ODD_EVEN,
		};
	}
}

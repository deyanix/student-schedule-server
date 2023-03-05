<?php

namespace App\Service\Calendar;

use App\Entity\Calendar\CalendarDayType;
use App\Entity\Calendar\CalendarWeekDay;
use Carbon\CarbonInterface;
use DateTime;

class CalendarService {
	private Calendar $calendar;

	public function __construct() {
		$this->calendar = (new CalendarBuilder())
			->initialize(
				new DateTime("2023-02-20"),
				new DateTime("2023-04-28")
			)
			->initialize(
				new DateTime("2023-05-08"),
				new DateTime("2023-06-16")
			)
			->setTypeBetween(
				new DateTime("2023-02-20"),
				new DateTime("2023-02-24"),
				CalendarDayType::ODD_EVEN
			)
			->setTypeBetween(
				new DateTime("2023-06-13"),
				new DateTime("2023-06-16"),
				CalendarDayType::EVEN
			)
			->setRearrangement(
				new DateTime("2023-04-05"),
				CalendarWeekDay::FRIDAY
			)
			->setRearrangement(
				new DateTime("2023-06-06"),
				CalendarWeekDay::FRIDAY
			)
			->remove(new DateTime("2023-04-07"))
			->remove(new DateTime("2023-04-10"))
			->remove(new DateTime("2023-05-12"))
			->remove(new DateTime("2023-06-08"))
			->remove(new DateTime("2023-06-09"))
			->build();
	}

	public function getCalendar(): Calendar {
		return $this->calendar;
	}
}
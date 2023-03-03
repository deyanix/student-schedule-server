<?php

namespace App\Entity;

use Carbon\Carbon;
use DateTime;

class WeeklyOccurrenceRule extends OccurrenceRule {
	private int $weekday;
	private ?SemesterDayType $type;

	public function __construct(
		DateTime $startTime,
		DateTime $endTime,
		int $weekday,
		?SemesterDayType $type = null,
		?string $title = null
	) {
		parent::__construct($startTime, $endTime, $title);
		$this->weekday = $weekday;
		$this->type = $type;
	}

	public function getOccurrences(SemesterCalendar $calendar): array {
		$dates = $calendar->findAll($this->weekday, $this->type);
		return array_map(fn ($date) => $this->createOccurrence($date), $dates);
	}

	public function getOccurrence(SemesterCalendar $calendar, DateTime $date): ?Occurrence {
		if ($calendar->match($date, $this->weekday, $this->type)) {
			return $this->createOccurrence($date);
		}
		return null;
	}
}
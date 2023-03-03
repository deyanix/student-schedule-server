<?php

namespace App\Entity;

use Carbon\Carbon;
use DateTime;

abstract class OccurrenceRule {
	private DateTime $startTime;
	private DateTime $endTime;
	private ?string $title;

	public function __construct(DateTime $startTime, DateTime $endTime, ?string $title = null) {
		$this->startTime = $startTime;
		$this->endTime = $endTime;
		$this->title = $title;
	}

	public function getStartTime(): DateTime {
		return $this->startTime;
	}

	public function getEndTime(): DateTime {
		return $this->endTime;
	}

	protected function createOccurrence(DateTime $date, ?string $title = null): Occurrence {
		$date = new Carbon($date);
		$startTime = new Carbon($this->startTime);
		$endTime = new Carbon($this->endTime);

		$start = $date->setTime($startTime->hour, $startTime->minute)->toDate();
		$end = $date->setTime($endTime->hour, $endTime->minute)->toDate();
		return new Occurrence($start, $end, $title ?? $this->title);
	}

	public abstract function getOccurrence(SemesterCalendar $calendar, DateTime $date): ?Occurrence;

	public abstract function getOccurrences(SemesterCalendar $calendar): array;
}
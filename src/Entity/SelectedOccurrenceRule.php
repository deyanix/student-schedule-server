<?php

namespace App\Entity;

use Carbon\Carbon;
use DateTime;

class SelectedOccurrenceRule extends OccurrenceRule {
	/** @var SelectedOccurrenceItem[] */
	private array $dates;

	public function __construct(
		DateTime $startTime,
		DateTime $endTime,
		array $dates,
		?string $title = null
	) {
		parent::__construct($startTime, $endTime, $title);
		$this->dates = $dates;
	}

	public function getDates(): array {
		return $this->dates;
	}

	public function getOccurrences(SemesterCalendar $calendar): array {
		$dates = array_filter(
			$this->dates,
			fn ($item) => $calendar->match($item->getDate())
		);
		return array_map(
			fn ($item) => $this->createOccurrence($item->getDate(), $item->getTitle()),
			$dates
		);
	}

	public function getOccurrence(SemesterCalendar $calendar, DateTime $date): ?Occurrence {
		$date = new Carbon($date);
		foreach ($this->dates as $item) {
			if ($date->isSameDay($item->getDate())) {
				return $this->createOccurrence($item->getDate(), $item->getTitle());
			}
		}
		return null;
	}
}
<?php

namespace App\Entity;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Carbon\CarbonPeriod;
use DateTime;

class SemesterCalendar {
	public SemesterDayCollection $collection;
	public DateTime $start;
	public DateTime $end;

	public function __construct(SemesterDayCollection $collection) {
		$this->collection = $collection;
		$this->start = $collection->min();
		$this->end = $collection->max();
	}

	public function getStartDate(): DateTime {
		return $this->start;
	}

	public function getEndDate(): DateTime {
		return $this->end;
	}

	public function match(DateTime $date, ?int $weekday = null, ?SemesterDayType $type = null): bool {
		$day = $this->collection->get($date);
		return $day !== null &&
			($weekday === null || $day->getWeekday() === $weekday) &&
			($type === null || $day->matchType($type));
	}

	public function next(DateTime $date, ?int $weekday = null, ?SemesterDayType $type = null): ?DateTime {
		$start = (new Carbon($this->start))->subDay()->max($date);
		return CarbonPeriod::create($start, $this->end, CarbonPeriod::EXCLUDE_START_DATE)
			->addFilter(fn ($carbonDate) => $this->match($carbonDate->toDate(), $weekday, $type))
			->current()
			?->toDate();
	}

	public function findAll(?int $weekday = null, ?SemesterDayType $type = null): array {
		$iterator = CarbonPeriod::create($this->start, $this->end)
			->addFilter(fn ($carbonDate) => $this->match($carbonDate->toDate(), $weekday, $type))
			->map(fn ($carbonDate) => $carbonDate->toDate());
		return iterator_to_array($iterator);
	}

	public function toCollection(): SemesterDayCollection {
		return $this->collection->clone();
	}
}
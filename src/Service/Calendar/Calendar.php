<?php

namespace App\Service\Calendar;

use App\Entity\Calendar\CalendarDayType;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateTime;

class Calendar {
	public CalendarDayCollection $collection;
	public DateTime $start;
	public DateTime $end;

	public function __construct(CalendarDayCollection $collection) {
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

	public function match(DateTime $date, ?int $weekday = null, ?CalendarDayType $type = null): bool {
		$day = $this->collection->get($date);
		return $day !== null &&
			($weekday === null || $day->getWeekDay() === $weekday) &&
			($type === null || $day->matchType($type));
	}

	public function next(DateTime $date, ?int $weekday = null, ?CalendarDayType $type = null): ?DateTime {
		$start = (new Carbon($this->start))->subDay()->max($date);
		return CarbonPeriod::create($start, $this->end, CarbonPeriod::EXCLUDE_START_DATE)
			->addFilter(fn ($carbonDate) => $this->match($carbonDate->toDate(), $weekday, $type))
			->current()
			?->toDate();
	}

	public function findAll(?int $weekday = null, ?CalendarDayType $type = null): array {
		$iterator = CarbonPeriod::create($this->start, $this->end)
			->addFilter(fn ($carbonDate) => $this->match($carbonDate->toDate(), $weekday, $type))
			->map(fn ($carbonDate) => $carbonDate->toDate());
		return iterator_to_array($iterator);
	}

	public function toCollection(): CalendarDayCollection {
		return $this->collection->clone();
	}
}
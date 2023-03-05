<?php

namespace App\Service\Calendar;

use App\Entity\Calendar\CalendarDayType;
use App\Entity\Calendar\CalendarWeekDay;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Carbon\CarbonPeriod;
use DateTime;

class CalendarBuilder {
	private CalendarDayCollection $collection;

	public function __construct() {
		$this->collection = new CalendarDayCollection();
	}

	public function initialize(DateTime $from, DateTime $to, CalendarDayType $startType = CalendarDayType::EVEN): self {
		$start = new Carbon($from);
		if (!$start->isMonday()) {
			$start = $start->previous(CarbonInterface::MONDAY);
		}

		CarbonPeriod::between($from, $to)
			->addFilter('isWeekday')
			->forEach(function ($d) use ($startType, $start) {
				$day = $this->collection->getOrCreate($d->toDate());
				$day->setType($start->diffInWeeks($d) % 2 === 0 ? $startType : $startType->opposite());
			});

		return $this;
	}

	public function remove(DateTime $date): self {
		$this->collection->remove($date);
		return $this;
	}

	public function removeEach(array $dates): self {
		foreach ($dates as $date) {
			$this->remove($date);
		}
		return $this;
	}

	public function removeBetween(DateTime $from, DateTime $to): self {
		$iterator = CarbonPeriod::between($from, $to)
			->map(fn ($d) => $d->toDate());
		$array = iterator_to_array($iterator);
		return $this->removeEach($array);
	}

	public function setRearrangement(DateTime $date, CalendarWeekDay $weekday): self {
		$this->collection->get($date)?->setRearrangedWeekDay($weekday);
		return $this;
	}

	public function setType(DateTime $date, CalendarDayType $type): self {
		$this->collection->get($date)?->setType($type);
		return $this;
	}

	public function setTypeEach(array $dates, CalendarDayType $type): self {
		foreach ($dates as $date) {
			$this->setType($date, $type);
		}
		return $this;
	}

	public function setTypeBetween(DateTime $from, DateTime $to, CalendarDayType $type): self {
		$iterator = CarbonPeriod::between($from, $to)
			->map(fn ($d) => $d->toDate());
		$array = iterator_to_array($iterator);
		return $this->setTypeEach($array, $type);
	}

	public function build(): Calendar {
		$collection = $this->collection->clone();
		$collection->sort();
		return new Calendar($collection);
	}
}
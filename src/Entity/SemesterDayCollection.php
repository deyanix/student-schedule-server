<?php

namespace App\Entity;

use Carbon\Carbon;
use DateTime;

class SemesterDayCollection {

	/** @var SemesterDay[] */
	private array $days;

	public function __construct(array $days = []) {
		$this->days = $days;
	}

	public function min(): ?DateTime {
		if (sizeof($this->days) === 0) {
			return null;
		}

		return array_reduce($this->days, function ($previous, $day) {
			return $previous->min($day->getDate());
		}, new Carbon($this->days[0]->getDate()))->toDate();
	}

	public function max(): ?DateTime {
		if (sizeof($this->days) === 0) {
			return null;
		}

		return array_reduce($this->days, function ($previous, $day) {
			return $previous->max($day->getDate());
		}, new Carbon($this->days[0]->getDate()))->toDate();
	}

	public function indexOf(DateTime $date): ?int {
		$carbonDate = new Carbon($date);
		foreach ($this->days as $index => $day) {
			if ($carbonDate->isSameDay($day->getDate())) {
				return $index;
			}
		}
		return null;
	}

	public function get(DateTime $date): SemesterDay | null {
		$index = $this->indexOf($date);
		return $index !== null ? $this->days[$index] : null;
	}

	public function create(DateTime $date): SemesterDay {
		$day = new SemesterDay($date);
		$this->days[] = $day;
		return $day;
	}

	public function getOrCreate(DateTime $date): SemesterDay {
		return $this->get($date) ?: $this->create($date);
	}

	public function remove(DateTime $date): void {
		$index = $this->indexOf($date);
		if ($index !== null) {
			unset($this->days[$index]);
		}
	}

	public function sort(): void {
		usort($this->days, function ($d1, $d2) {
			$cd1 = (new Carbon($d1->getDate()))->startOfDay();
			$cd2 = (new Carbon($d2->getDate()))->startOfDay();
			if ($cd1->isSameDay($cd2)) {
				return 0;
			} else if ($cd1->greaterThan($cd2)) {
				return 1;
			} else {
				return -1;
			}
		});
	}

	public function clone(): self {
		return new SemesterDayCollection(array_values($this->days));
	}
}
<?php

namespace App\Entity;

use Carbon\Carbon;
use DateTime;

class SemesterDay {
	private DateTime $date;
	private ?SemesterDayType $type;
	private ?int $rearrangedWeekday;

	public function __construct(DateTime $date, ?SemesterDayType $type = null, ?int $rearrangedWeekday = null) {
		$this->date = $date;
		$this->type = $type;
		$this->rearrangedWeekday = $rearrangedWeekday;
	}

	public function getDate(): DateTime {
		return $this->date;
	}

	public function getType(): ?SemesterDayType {
		return $this->type;
	}

	public function matchType(SemesterDayType $type): bool {
		return $this->type === $type || $this->type === SemesterDayType::ODD_EVEN;
	}

	public function setType(?SemesterDayType $type): void {
		$this->type = $type;
	}

	public function getRearrangedWeekday(): ?int {
		return $this->rearrangedWeekday;
	}

	public function getWeekday(): int {
		return $this->getRearrangedWeekday() ?: (new Carbon($this->date))->dayOfWeek;
	}

	public function setRearrangedWeekday(?int $rearrangedWeekday): void {
		$this->rearrangedWeekday = $rearrangedWeekday;
	}
}
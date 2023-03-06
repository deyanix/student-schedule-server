<?php

namespace App\Entity\Calendar;

use Carbon\Carbon;
use DateTime;
use JMS\Serializer\Annotation as Serializer;

class CalendarDay {
	private DateTime $date;
	#[Serializer\Type("Enum")]
	private ?CalendarDayType $type;
	#[Serializer\Type("Enum")]
	private ?CalendarWeekDay $rearrangedWeekDay;

	public function __construct(DateTime $date, ?CalendarDayType $type = null, ?CalendarWeekDay $rearrangedWeekday = null) {
		$this->date = $date;
		$this->type = $type;
		$this->rearrangedWeekDay = $rearrangedWeekday;
	}

	public function getDate(): DateTime {
		return $this->date;
	}

	public function getType(): ?CalendarDayType {
		return $this->type;
	}

	public function matchType(CalendarDayType $type): bool {
		return $this->type === $type || $this->type === CalendarDayType::ODD_EVEN;
	}

	public function setType(?CalendarDayType $type): void {
		$this->type = $type;
	}

	public function getRearrangedWeekDay(): ?CalendarWeekDay {
		return $this->rearrangedWeekDay;
	}

	public function getWeekDay(): ?int {
		return $this->getRearrangedWeekDay()?->value ?: (new Carbon($this->date))->dayOfWeek;
	}

	public function setRearrangedWeekDay(?CalendarWeekDay $rearrangedWeekDay): void {
		$this->rearrangedWeekDay = $rearrangedWeekDay;
	}
}
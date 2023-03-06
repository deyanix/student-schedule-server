<?php

namespace App\Entity\Schedule;

use App\Entity\Calendar\CalendarDayType;
use App\Entity\Calendar\CalendarWeekDay;
use DateTime;
use JMS\Serializer\Annotation as Serializer;

class ScheduleDay {
    private DateTime $date;
	#[Serializer\Type("Enum")]
	private ?CalendarDayType $type;
	#[Serializer\Type("Enum")]
	private ?CalendarWeekDay $rearrangedWeekDay;
    private array $occurrences;

	/**
	 * @return DateTime
	 */
	public function getDate(): DateTime {
		return $this->date;
	}

	/**
	 * @param DateTime $date
	 * @return ScheduleDay
	 */
	public function setDate(DateTime $date): ScheduleDay {
		$this->date = $date;
		return $this;
	}

	/**
	 * @return CalendarDayType|null
	 */
	public function getType(): ?CalendarDayType {
		return $this->type;
	}

	/**
	 * @param CalendarDayType|null $type
	 * @return ScheduleDay
	 */
	public function setType(?CalendarDayType $type): ScheduleDay {
		$this->type = $type;
		return $this;
	}

	/**
	 * @return CalendarWeekDay|null
	 */
	public function getRearrangedWeekDay(): ?CalendarWeekDay {
		return $this->rearrangedWeekDay;
	}

	/**
	 * @param CalendarWeekDay|null $rearrangedWeekDay
	 * @return ScheduleDay
	 */
	public function setRearrangedWeekDay(?CalendarWeekDay $rearrangedWeekDay): ScheduleDay {
		$this->rearrangedWeekDay = $rearrangedWeekDay;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getOccurrences(): array {
		return $this->occurrences;
	}

	/**
	 * @param array $occurrences
	 * @return ScheduleDay
	 */
	public function setOccurrences(array $occurrences): ScheduleDay {
		$this->occurrences = $occurrences;
		return $this;
	}
}

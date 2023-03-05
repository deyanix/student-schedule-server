<?php

namespace App\Entity\Occurrence;

use App\Entity\Calendar\CalendarDayType;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class WeeklyOccurrenceRule extends OccurrenceRule {
	#[ORM\Column(type: 'smallint')]
	private int $weekday;
	#[ORM\Column(type: 'string', enumType: CalendarDayType::class)]
	private ?CalendarDayType $type;

	/**
	 * @return int
	 */
	public function getWeekday(): int {
		return $this->weekday;
	}

	/**
	 * @param int $weekday
	 */
	public function setWeekday(int $weekday): void {
		$this->weekday = $weekday;
	}

	/**
	 * @return CalendarDayType|null
	 */
	public function getType(): ?CalendarDayType {
		return $this->type;
	}

	/**
	 * @param CalendarDayType|null $type
	 */
	public function setType(?CalendarDayType $type): void {
		$this->type = $type;
	}
}
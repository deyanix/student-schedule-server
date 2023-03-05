<?php

namespace App\Service\Occurrence;

use App\Entity\Occurrence\Occurrence;
use App\Entity\Occurrence\OccurrenceRule;
use App\Entity\Occurrence\SelectedOccurrenceItem;
use App\Entity\Occurrence\SelectedOccurrenceRule;
use App\Entity\Occurrence\WeeklyOccurrenceRule;
use App\Service\Calendar\Calendar;
use App\Service\Calendar\CalendarService;
use Carbon\Carbon;
use DateTime;
use InvalidArgumentException;

class OccurrenceService {
	private CalendarService $calendarService;

	public function __construct(CalendarService $calendarService) {
		$this->calendarService = $calendarService;
	}

	public function getSelectedOccurrences(SelectedOccurrenceRule $rule): array {
		return $rule->getItems()
			->filter(fn ($item) => $this->calendarService->getCalendar()->match($item->getDate()))
			->map(fn ($item) => $this->createOccurrence($rule, $item->getDate(), $item->getTitle()))
			->toArray();
	}

	public function getSelectedDayOccurrence(SelectedOccurrenceRule $rule, DateTime $date): ?Occurrence {
		$date = new Carbon($date);
		$item = $rule->getItems()->findFirst(fn ($item) => $date->isSameDay($item->getDate()));
		if ($item == null) {
			return null;
		}

		return $this->createOccurrence($rule, $item->getDate(), $item->getTitle());
	}

	public function getWeeklyOccurrences(WeeklyOccurrenceRule $rule): array {
		$dates = $this->calendarService->getCalendar()->findAll($rule->getWeekday(), $rule->getType());
		return array_map(fn ($date) => $this->createOccurrence($rule, $date), $dates);
	}

	public function getWeeklyDayOccurrence(WeeklyOccurrenceRule $rule, DateTime $date): ?Occurrence {
		if ($this->calendarService->getCalendar()->match($date, $rule->getWeekday(), $rule->getType())) {
			return $this->createOccurrence($rule, $date);
		}
		return null;
	}

	public function getOccurrences(OccurrenceRule $rule): array {
		if ($rule instanceof WeeklyOccurrenceRule) {
			return $this->getWeeklyOccurrences($rule);
		} else if ($rule instanceof SelectedOccurrenceRule) {
			return $this->getSelectedOccurrences($rule);
		} else {
			throw new InvalidArgumentException("Not recognized rule");
		}
	}

	public function getDayOccurrence(OccurrenceRule $rule, DateTime $date): ?Occurrence {
		if ($rule instanceof WeeklyOccurrenceRule) {
			return $this->getWeeklyDayOccurrence($rule, $date);
		} else if ($rule instanceof SelectedOccurrenceRule) {
			return $this->getSelectedDayOccurrence($rule, $date);
		} else {
			throw new InvalidArgumentException("Not recognized rule");
		}
	}

	public function getRulesOccurrences(array $rules): array {
		$result = [];
		foreach ($rules as $rule) {
			array_push($result, ...$rule->getOccurrences());
		}
		return $result;
	}

	public function getRulesDayOccurrences(DateTime $date, array $rules): array {
		$result = [];
		foreach ($rules as $rule) {
			$occurrence = $rule->getOccurrence($date);
			if ($occurrence !== null) {
				$result[] = $occurrence;
			}
		}
		return $result;
	}

	private function createOccurrence(OccurrenceRule $rule, DateTime $date, ?string $title = null): Occurrence {
		$date = new Carbon($date);
		$startTime = new Carbon($rule->getStartTime());
		$endTime = new Carbon($rule->getEndTime());

		$start = $date->setTime($startTime->hour, $startTime->minute)->toDate();
		$end = $date->setTime($endTime->hour, $endTime->minute)->toDate();
		return new Occurrence($start, $end, $title ?? $rule->getTitle());
	}
}

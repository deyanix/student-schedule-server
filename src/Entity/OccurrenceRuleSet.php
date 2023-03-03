<?php

namespace App\Entity;

use Carbon\Carbon;
use DateTime;

class OccurrenceRuleSet {
	/** @var OccurrenceRule[] */
	private array $rules = [];

	public function addRule(OccurrenceRule $rule): self {
		$this->rules[] = $rule;
		return $this;
	}

	public function getDayOccurrences(SemesterCalendar $calendar, DateTime $date): array {
		$result = [];
		foreach ($this->rules as $rule) {
			$occurrence = $rule->getOccurrence($calendar, $date);
			if ($occurrence !== null) {
				$result[] = $occurrence;
			}
		}
		return $result;
	}

	public function getOccurrences(SemesterCalendar $calendar): array {
		$result = [];
		foreach ($this->rules as $rule) {
			array_push($result, ...$rule->getOccurrences($calendar));
		}
		return $result;
	}
}
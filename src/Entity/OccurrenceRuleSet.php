<?php

namespace App\Entity;

use Carbon\Carbon;
use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class OccurrenceRuleSet {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', options: ['unsigned' => true])]
    private int $id;
	#[ORM\OneToMany(targetEntity: OccurrenceRule::class, mappedBy: 'ruleSet')]
	private Collection $rules;

//    public function addRule(OccurrenceRule $rule): self {
//		$this->rules[] = $rule;
//		return $this;
//	}
//
//	public function getDayOccurrences(SemesterCalendar $calendar, DateTime $date): array {
//		$result = [];
//		foreach ($this->rules as $rule) {
//			$occurrence = $rule->getOccurrence($calendar, $date);
//			if ($occurrence !== null) {
//				$result[] = $occurrence;
//			}
//		}
//		return $result;
//	}
//
//	public function getOccurrences(SemesterCalendar $calendar): array {
//		$result = [];
//		foreach ($this->rules as $rule) {
//			array_push($result, ...$rule->getOccurrences($calendar));
//		}
//		return $result;
//	}
}

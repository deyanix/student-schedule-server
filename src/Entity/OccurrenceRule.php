<?php

namespace App\Entity;

use Carbon\Carbon;
use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
abstract class OccurrenceRule {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', options: ['unsigned' => true])]
    private int $id;
    #[ORM\Column(type: 'time')]
	private DateTime $startTime;
    #[ORM\Column(type: 'time')]
	private DateTime $endTime;
    #[ORM\Column(type: 'string', nullable: true)]
	private ?string $title;
    #[ORM\ManyToOne(targetEntity: OccurrenceRuleSet::class, inversedBy: 'rules')]
    private OccurrenceRuleSet $ruleSet;

	public function __construct(DateTime $startTime, DateTime $endTime, ?string $title = null) {
		$this->startTime = $startTime;
		$this->endTime = $endTime;
		$this->title = $title;
	}

	public function getStartTime(): DateTime {
		return $this->startTime;
	}

	public function getEndTime(): DateTime {
		return $this->endTime;
	}

	protected function createOccurrence(DateTime $date, ?string $title = null): Occurrence {
		$date = new Carbon($date);
		$startTime = new Carbon($this->startTime);
		$endTime = new Carbon($this->endTime);

		$start = $date->setTime($startTime->hour, $startTime->minute)->toDate();
		$end = $date->setTime($endTime->hour, $endTime->minute)->toDate();
		return new Occurrence($start, $end, $title ?? $this->title);
	}

	public abstract function getOccurrence(SemesterCalendar $calendar, DateTime $date): ?Occurrence;

	public abstract function getOccurrences(SemesterCalendar $calendar): array;
}

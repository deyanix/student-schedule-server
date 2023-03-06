<?php

namespace App\Service\Schedule;

use App\Entity\Schedule\ScheduleDay;
use App\Entity\Schedule\ScheduleOccurrence;
use App\Service\Calendar\CalendarService;
use App\Service\Course\CourseService;
use App\Service\Occurrence\OccurrenceService;
use Carbon\Carbon;
use DateTime;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ScheduleService {
	public function __construct(
		private readonly CalendarService $calendarService,
		private readonly CourseService $courseService,
		private readonly OccurrenceService $occurrenceService,
	) {}

	public function getScheduleDay(DateTime $date): ScheduleDay {
		$date = new Carbon($date);
		$calendarDay = $this->calendarService->getCalendar()->toCollection()->get($date);
		if ($calendarDay == null) {
			return (new ScheduleDay())
				->setDate($date->startOfDay())
				->setType(null)
				->setRearrangedWeekDay(null)
				->setOccurrences([]);
		}

		$scheduleOccurrences = [];
		$courses = $this->courseService->getAll();
		foreach ($courses as $course) {
			foreach ($course->getClasses() as $class) {
				$occurrences = $this->occurrenceService->getRulesDayOccurrences(
					$date,
					$class->getRules()->toArray()
				);
				foreach ($occurrences as $occurrence) {
					$scheduleOccurrences[] = (new ScheduleOccurrence())
						->setCourseId($course->getId())
						->setName($course->getName())
						->setClassId($class->getId())
						->setType($class->getType())
						->setStart($occurrence->getStart())
						->setEnd($occurrence->getEnd())
						->setTitle($occurrence->getTitle());
				}
			}
		}

		return (new ScheduleDay())
			->setDate($calendarDay->getDate())
			->setType($calendarDay->getType())
			->setRearrangedWeekDay($calendarDay->getRearrangedWeekDay())
			->setOccurrences($scheduleOccurrences);
	}
}
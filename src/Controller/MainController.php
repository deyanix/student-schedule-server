<?php

namespace App\Controller;

use App\Entity\Course;
use App\Entity\OccurrenceRuleSet;
use App\Entity\SelectedOccurrenceItem;
use App\Entity\SelectedOccurrenceRule;
use App\Entity\SemesterCalendar;
use App\Entity\SemesterCalendarBuilder;
use App\Entity\SemesterDayType;
use App\Entity\WeeklyOccurrenceRule;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\Annotations as Rest;

class MainController extends AbstractController {
    public function getCalendar(): SemesterCalendar {
        return (new SemesterCalendarBuilder())
            ->initialize(
                new DateTime("2023-02-20"),
                new DateTime("2023-04-28")
            )
            ->initialize(
                new DateTime("2023-05-08"),
                new DateTime("2023-06-16")
            )
            ->setTypeBetween(
                new DateTime("2023-02-20"),
                new DateTime("2023-02-24"),
                SemesterDayType::ODD_EVEN
            )
            ->setTypeBetween(
                new DateTime("2023-06-13"),
                new DateTime("2023-06-16"),
                SemesterDayType::EVEN
            )
            ->setRearrangement(
                new DateTime("2023-04-05"),
                CarbonInterface::FRIDAY
            )
            ->setRearrangement(
                new DateTime("2023-06-06"),
                CarbonInterface::FRIDAY
            )
            ->remove(new DateTime("2023-04-07"))
            ->remove(new DateTime("2023-04-10"))
            ->remove(new DateTime("2023-05-12"))
            ->remove(new DateTime("2023-06-08"))
            ->remove(new DateTime("2023-06-09"))
            ->build();
    }

    #[Rest\View]
    #[Rest\Get("/")]
    public function get() {
        return [];
//        return [
//			'test' =>
//
//				(new OccurrenceRuleSet())
//					->addRule(new SelectedOccurrenceRule(
//						new DateTime("12:15"),
//						new DateTime("16:00"),
//						[
//							new SelectedOccurrenceItem(new DateTime("2023-04-02"), "Lab1"),
//							new SelectedOccurrenceItem(new DateTime("2023-04-03"), "Lab2"),
//							new SelectedOccurrenceItem(new DateTime("2023-04-04"), "Lab3"),
//							new SelectedOccurrenceItem(new DateTime("2023-04-05"), "Lab4")
//						]
//					))
//					->addRule(new WeeklyOccurrenceRule(
//						new DateTime("13:15"),
//						new DateTime("14:00"),
//						CarbonInterface::FRIDAY,
//						SemesterDayType::EVEN
//					))->getDayOccurrences($calendar, new DateTime("2023-04-05"))
//        ];
    }

}

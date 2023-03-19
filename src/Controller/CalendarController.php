<?php

namespace App\Controller;

use App\Service\Calendar\CalendarService;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Rest\Route("/calendar")]
class CalendarController extends AbstractController {
	public function __construct(
		private readonly CalendarService $calendarService
	) {}

    #[Rest\View]
    #[Rest\Get]
    public function get() {
        return $this->calendarService->getCalendar()
	        ->toCollection()
	        ->toArray();
    }

}

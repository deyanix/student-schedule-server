<?php

namespace App\Controller;

use App\Service\Course\CourseClassService;
use App\Service\Course\CourseService;
use App\Service\Schedule\ScheduleService;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use DateTime;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

#[Rest\Route("/schedule")]
class ScheduleController extends AbstractController {
	public function __construct(
		private readonly ScheduleService $scheduleService
	) {}

	#[Rest\Get("/day")]
	#[Rest\View]
	public function day(Request $request) {
		$form = $this->createFormBuilder()
			->add('date', DateType::class, [
				'widget' => 'single_text',
				'format' => 'yyyy-MM-dd',
				'required' => true,
                'constraints' => [new Assert\NotNull()],
			])
			->getForm();

		$form->submit($request->query->all());
		if (!$form->isValid()) {
			return $form->getErrors();
		}

		return $this->scheduleService->getScheduleDay(
			$form->get('date')->getData()
		);
	}

	#[Rest\Get("/week")]
	#[Rest\View]
	public function week(Request $request) {
		$form = $this->createFormBuilder()
			->add('date', DateType::class, [
				'widget' => 'single_text',
				'format' => 'yyyy-MM-dd',
				'required' => true,
				'constraints' => [new Assert\NotNull()],
			])
			->getForm();

		$form->submit($request->query->all());
		if (!$form->isValid()) {
			return $form->getErrors();
		}

		$date = (new Carbon($form->get('date')->getData()))->startOfWeek(Carbon::MONDAY);
		$iterator = CarbonPeriod::create($date, 7)
			->map(fn ($carbonDate) =>
				$this->scheduleService->getScheduleDay($carbonDate->toDate())
			);
		return iterator_to_array($iterator);
	}
}
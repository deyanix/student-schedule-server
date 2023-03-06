<?php

namespace App\Controller;

use App\Service\Course\CourseClassService;
use App\Service\Course\CourseService;
use App\Service\Schedule\ScheduleService;
use Carbon\Carbon;
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
	public function all(Request $request) {
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
}
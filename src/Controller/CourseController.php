<?php

namespace App\Controller;

use App\Entity\Course\CourseClassType;
use App\Service\Course\CourseClassService;
use App\Service\Course\CourseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\Annotations as Rest;

#[Rest\Route("/courses")]
class CourseController extends AbstractController {
	public function __construct(
		private readonly CourseService $courseService,
		private readonly CourseClassService $courseClassService
	) {}

	#[Rest\Get("/")]
	#[Rest\View(serializerGroups: ['course:all'])]
	public function all() {
		return $this->courseService->getAll();
	}

	#[Rest\Get("/classes/{id}")]
	#[Rest\View(serializerGroups: ['course:all', 'occurrence_rule:all'])]
	public function getClass(int $id) {
		return $this->courseClassService->get($id);
	}

	#[Rest\Get("/classes/{id}/occurrences")]
	#[Rest\View]
	public function getClassOccurrences(int $id) {
		return $this->courseClassService->getOccurrences($id);
	}
}
<?php

namespace App\Service\Course;

use App\Entity\Course\CourseClass;
use App\Repository\CourseClassRepository;
use App\Service\Occurrence\OccurrenceService;

class CourseClassService {
	public function __construct(
		private readonly CourseClassRepository $courseClassRepository,
		private readonly OccurrenceService $occurrenceService
	) {}

	public function get(int $id): ?CourseClass {
		return $this->courseClassRepository->find($id);
	}

	public function getOccurrences(int $id): array {
		$class = $this->get($id);
		if ($class === null) {
			return [];
		}
		return $this->occurrenceService->getRulesOccurrences($class->getRules()->toArray());
	}
}
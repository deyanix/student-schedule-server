<?php

namespace App\Service\Course;

use App\Entity\Course\Course;
use App\Repository\CourseRepository;

class CourseService {
	public function __construct(
		private readonly CourseRepository $courseRepository
	) {}

	/**
	 * @return array<int, Course>
	 */
	public function getAll(): array {
		return $this->courseRepository->findAll();
	}
}
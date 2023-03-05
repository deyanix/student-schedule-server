<?php

namespace App\Entity\Course;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class CourseClass {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', options: ['unsigned' => true])]
    private int $id;
    #[ORM\ManyToOne(targetEntity: Course::class, inversedBy: 'classes')]
	private Course $course;

    #[ORM\Column(type: 'string', enumType: CourseClassType::class)]
	private CourseClassType $type;

	/**
	 * @return int
	 */
	public function getId(): int {
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId(int $id): void {
		$this->id = $id;
	}

	/**
	 * @return Course
	 */
	public function getCourse(): Course {
		return $this->course;
	}

	/**
	 * @param Course $course
	 */
	public function setCourse(Course $course): void {
		$this->course = $course;
	}

	/**
	 * @return CourseClassType
	 */
	public function getType(): CourseClassType {
		return $this->type;
	}

	/**
	 * @param CourseClassType $type
	 */
	public function setType(CourseClassType $type): void {
		$this->type = $type;
	}
}

<?php

namespace App\Entity\Course;

use App\Entity\Occurrence\SelectedOccurrenceRule;
use App\Entity\Occurrence\WeeklyOccurrenceRule;
use App\Repository\CourseClassRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

#[ORM\Entity(repositoryClass: CourseClassRepository::class)]
class CourseClass {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', options: ['unsigned' => true])]
    #[Serializer\Groups(["course:all"])]
    private int $id;
    #[ORM\ManyToOne(targetEntity: Course::class, inversedBy: 'classes')]
	private Course $course;

    #[ORM\Column(type: 'string', enumType: CourseClassType::class)]
    #[Serializer\Groups(["course:all"])]
    #[Serializer\Type("Enum")]
	private CourseClassType $type;
	#[ORM\OneToMany(targetEntity: WeeklyOccurrenceRule::class, mappedBy: 'class')]
	private Collection $weeklyRules;
	#[ORM\OneToMany(targetEntity: SelectedOccurrenceRule::class, mappedBy: 'class')]
	private Collection $selectedRules;

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

	/**
	 * @return Collection
	 */
	public function getWeeklyRules(): Collection {
		return $this->weeklyRules;
	}

	/**
	 * @param Collection $weeklyRules
	 */
	public function setWeeklyRules(Collection $weeklyRules): void {
		$this->weeklyRules = $weeklyRules;
	}

	/**
	 * @return Collection
	 */
	public function getSelectedRules(): Collection {
		return $this->selectedRules;
	}

	/**
	 * @param Collection $selectedRules
	 */
	public function setSelectedRules(Collection $selectedRules): void {
		$this->selectedRules = $selectedRules;
	}

	/**
	 * @return Collection
	 */
	public function getRules(): Collection {
		return new ArrayCollection(
			array_merge(
				$this->getWeeklyRules()->toArray(),
				$this->getSelectedRules()->toArray()
			)
		);
	}
}

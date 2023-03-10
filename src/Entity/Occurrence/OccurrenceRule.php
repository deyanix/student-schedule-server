<?php

namespace App\Entity\Occurrence;

use App\Entity\Course\CourseClass;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

#[ORM\MappedSuperclass]
class OccurrenceRule {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', options: ['unsigned' => true])]
    #[Serializer\Groups(["occurrence_rule:all"])]
    private int $id;
    #[ORM\Column(type: 'time')]
    #[Serializer\Groups(["occurrence_rule:all"])]
	private DateTime $startTime;
    #[ORM\Column(type: 'time')]
    #[Serializer\Groups(["occurrence_rule:all"])]
	private DateTime $endTime;
    #[ORM\Column(type: 'string', nullable: true)]
    #[Serializer\Groups(["occurrence_rule:all"])]
	private ?string $title;
    #[ORM\ManyToOne(targetEntity: CourseClass::class, inversedBy: 'rules')]
    #[Serializer\Groups(["occurrence_rule:all"])]
    private CourseClass $class;

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
	 * @return DateTime
	 */
	public function getStartTime(): DateTime {
		return $this->startTime;
	}

	/**
	 * @param DateTime $startTime
	 */
	public function setStartTime(DateTime $startTime): void {
		$this->startTime = $startTime;
	}

	/**
	 * @return DateTime
	 */
	public function getEndTime(): DateTime {
		return $this->endTime;
	}

	/**
	 * @param DateTime $endTime
	 */
	public function setEndTime(DateTime $endTime): void {
		$this->endTime = $endTime;
	}

	/**
	 * @return string|null
	 */
	public function getTitle(): ?string {
		return $this->title;
	}

	/**
	 * @param string|null $title
	 */
	public function setTitle(?string $title): void {
		$this->title = $title;
	}

	/**
	 * @return CourseClass
	 */
	public function getClass(): CourseClass {
		return $this->class;
	}

	/**
	 * @param CourseClass $class
	 */
	public function setClass(CourseClass $class): void {
		$this->class = $class;
	}
}

<?php

namespace App\Entity\Schedule;

use App\Entity\Course\CourseClassType;
use DateTime;
use JMS\Serializer\Annotation as Serializer;

class ScheduleOccurrence {
	private int $courseId;
	private string $name;
	private int $classId;
	#[Serializer\Type("Enum")]
    private CourseClassType $type;
    private ?string $title;
    private DateTime $start;
    private DateTime $end;

	/**
	 * @return int
	 */
	public function getCourseId(): int {
		return $this->courseId;
	}

	/**
	 * @param int $courseId
	 * @return ScheduleOccurrence
	 */
	public function setCourseId(int $courseId): ScheduleOccurrence {
		$this->courseId = $courseId;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getClassId(): int {
		return $this->classId;
	}

	/**
	 * @param int $classId
	 * @return ScheduleOccurrence
	 */
	public function setClassId(int $classId): ScheduleOccurrence {
		$this->classId = $classId;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getName(): string {
		return $this->name;
	}

	/**
	 * @param string $name
	 * @return ScheduleOccurrence
	 */
	public function setName(string $name): ScheduleOccurrence {
		$this->name = $name;
		return $this;
	}

	/**
	 * @return CourseClassType
	 */
	public function getType(): CourseClassType {
		return $this->type;
	}

	/**
	 * @param CourseClassType $type
	 * @return ScheduleOccurrence
	 */
	public function setType(CourseClassType $type): ScheduleOccurrence {
		$this->type = $type;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getTitle(): ?string {
		return $this->title;
	}

	/**
	 * @param string|null $title
	 * @return ScheduleOccurrence
	 */
	public function setTitle(?string $title): ScheduleOccurrence {
		$this->title = $title;
		return $this;
	}

	/**
	 * @return DateTime
	 */
	public function getStart(): DateTime {
		return $this->start;
	}

	/**
	 * @param DateTime $start
	 * @return ScheduleOccurrence
	 */
	public function setStart(DateTime $start): ScheduleOccurrence {
		$this->start = $start;
		return $this;
	}

	/**
	 * @return DateTime
	 */
	public function getEnd(): DateTime {
		return $this->end;
	}

	/**
	 * @param DateTime $end
	 * @return ScheduleOccurrence
	 */
	public function setEnd(DateTime $end): ScheduleOccurrence {
		$this->end = $end;
		return $this;
	}
}

<?php

namespace App\Entity\Course;

use App\Repository\CourseRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
class Course {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', options: ['unsigned' => true])]
    #[Serializer\Groups(["course:all"])]
    private int $id;

    #[ORM\Column(type: 'string')]
    #[Serializer\Groups(["course:all"])]
    private string $name;

    #[ORM\OneToMany(targetEntity: CourseClass::class, mappedBy: 'course')]
    #[Serializer\Groups(["course:all"])]
	private Collection $classes;

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
	 * @return string
	 */
	public function getName(): string {
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName(string $name): void {
		$this->name = $name;
	}

	/**
	 * @psalm-return Collection<int, CourseClass>
	 */
	public function getClasses(): Collection {
		return $this->classes;
	}

	/**
	 * @param Collection<int, CourseClass> $classes
	 */
	public function setClasses(Collection $classes): void {
		$this->classes = $classes;
	}
}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Course {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', options: ['unsigned' => true])]
    private int $id;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\OneToMany(targetEntity: CourseClass::class, mappedBy: 'course')]
	private Collection $classes;

    public function __construct(string $name) {
        $this->name = $name;
        $this->classes = [];
    }

    public function getName() {
        return $this->name;
    }

    public function getClasses(): array {
        return $this->classes;
    }
}

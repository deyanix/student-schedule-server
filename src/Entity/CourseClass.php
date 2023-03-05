<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
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

}

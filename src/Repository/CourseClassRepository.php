<?php

namespace App\Repository;

use App\Entity\Course\CourseClass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CourseClassRepository extends ServiceEntityRepository {
	public function __construct(ManagerRegistry $registry) {
		parent::__construct($registry, CourseClass::class);
	}
}
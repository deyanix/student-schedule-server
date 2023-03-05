<?php

namespace App\Entity\Course;

enum CourseClassType {
	case LECTURE;
	case TUTORIAL;
	case INTEGRATED;
	case LABORATORY;
	case PROJECT;
}

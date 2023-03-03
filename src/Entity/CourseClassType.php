<?php

namespace App\Entity;

enum CourseClassType {
	case LECTURE;
	case TUTORIAL;
	case INTEGRATED;
	case LABORATORY;
	case PROJECT;
}

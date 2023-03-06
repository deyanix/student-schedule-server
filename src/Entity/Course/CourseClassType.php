<?php

namespace App\Entity\Course;

enum CourseClassType: string {
	case LECTURE = 'lecture';
	case TUTORIAL = 'tutorial';
	case INTEGRATED = 'integrated';
	case LABORATORY = 'laboratory';
	case PROJECT = 'project';
}

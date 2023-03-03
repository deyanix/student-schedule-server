<?php

namespace App\Entity;

class CourseClass {
	private Course $course;
	private CourseClassType $type;
	private string $room;
	private OccurrenceRuleSet $ruleSet;
}
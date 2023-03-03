<?php

namespace App\Entity;

use DateTime;

class SelectedOccurrenceItem {
	private DateTime $date;
	private ?string $title;

	public function __construct(DateTime $date, ?string $title = null) {
		$this->date = $date;
		$this->title = $title;
	}

	public function getDate(): DateTime {
		return $this->date;
	}

	public function getTitle(): ?string {
		return $this->title;
	}
}
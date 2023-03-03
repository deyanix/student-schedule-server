<?php

namespace App\Entity;

use DateTime;

class Occurrence {
	private DateTime $start;
	private DateTime $end;
	private ?string $title;

	public function __construct(DateTime $start, DateTime $end, ?string $title = null) {
		$this->start = $start;
		$this->end = $end;
		$this->title = $title;
	}

	public function getStart(): DateTime {
		return $this->start;
	}

	public function setStart(DateTime $start): void {
		$this->start = $start;
	}

	public function getEnd(): DateTime {
		return $this->end;
	}

	public function setEnd(DateTime $end): void {
		$this->end = $end;
	}

	public function getTitle(): ?string {
		return $this->title;
	}

	public function setTitle(?string $title): void {
		$this->title = $title;
	}
}
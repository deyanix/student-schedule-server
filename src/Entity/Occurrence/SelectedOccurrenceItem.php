<?php

namespace App\Entity\Occurrence;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class SelectedOccurrenceItem {
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column(type: 'integer', options: ['unsigned' => true])]
	private int $id;
	#[ORM\Column(type: 'date')]
	private DateTime $date;
	#[ORM\Column(type: 'string')]
	private ?string $title;
	#[ORM\ManyToOne(targetEntity: SelectedOccurrenceRule::class, inversedBy: 'items')]
	private SelectedOccurrenceRule $rule;

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
	 * @return DateTime
	 */
	public function getDate(): DateTime {
		return $this->date;
	}

	/**
	 * @param DateTime $date
	 */
	public function setDate(DateTime $date): void {
		$this->date = $date;
	}

	/**
	 * @return string|null
	 */
	public function getTitle(): ?string {
		return $this->title;
	}

	/**
	 * @param string|null $title
	 */
	public function setTitle(?string $title): void {
		$this->title = $title;
	}

	/**
	 * @return SelectedOccurrenceRule
	 */
	public function getRule(): SelectedOccurrenceRule {
		return $this->rule;
	}

	/**
	 * @param SelectedOccurrenceRule $rule
	 */
	public function setRule(SelectedOccurrenceRule $rule): void {
		$this->rule = $rule;
	}
}
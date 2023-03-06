<?php

namespace App\Entity\Occurrence;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

#[ORM\Entity]
class SelectedOccurrenceRule extends OccurrenceRule {
	#[ORM\OneToMany(targetEntity: SelectedOccurrenceItem::class, mappedBy: 'rule')]
	#[Serializer\Groups(["occurrence_rule:all"])]
	private Collection $items;

	/**
	 * @return Collection<int, SelectedOccurrenceItem>
	 */
	public function getItems(): Collection {
		return $this->items;
	}

	/**
	 * @param Collection<int, SelectedOccurrenceItem> $items
	 */
	public function setItems(Collection $items): void {
		$this->items = $items;
	}
}
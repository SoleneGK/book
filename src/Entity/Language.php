<?php

namespace App\Entity;

use App\Repository\LanguageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LanguageRepository::class)
 */
class Language
{
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="text", unique=true)
	 */
	private $name;

	/**
	 * @ORM\OneToMany(targetEntity=Reading::class, mappedBy="language", orphanRemoval=true)
	 */
	private $readings;

	/**
	 * @ORM\OneToMany(targetEntity=Translation::class, mappedBy="language")
	 */
	private $translations;

	public function __construct()
	{
		$this->books = new ArrayCollection();
		$this->readings = new ArrayCollection();
		$this->translations = new ArrayCollection();
	}

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function setName(string $name): self
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * @return Collection|Reading[]
	 */
	public function getReadings(): Collection
	{
		return $this->readings;
	}

	public function addReading(Reading $reading): self
	{
		if (!$this->readings->contains($reading)) {
			$this->readings[] = $reading;
			$reading->setLanguage($this);
		}

		return $this;
	}

	public function removeReading(Reading $reading): self
	{
		if ($this->readings->contains($reading)) {
			$this->readings->removeElement($reading);
			// set the owning side to null (unless already changed)
			if ($reading->getLanguage() === $this) {
				$reading->setLanguage(null);
			}
		}

		return $this;
	}

	public function __toString()
	{
		return $this->name;
	}

	/**
	 * @return Collection|Translation[]
	 */
	public function getTranslations(): Collection
	{
		return $this->translations;
	}

	public function addTranslation(Translation $translation): self
	{
		if (!$this->translations->contains($translation)) {
			$this->translations[] = $translation;
			$translation->setLanguage($this);
		}

		return $this;
	}

	public function removeTranslation(Translation $translation): self
	{
		if ($this->translations->contains($translation)) {
			$this->translations->removeElement($translation);
			// set the owning side to null (unless already changed)
			if ($translation->getLanguage() === $this) {
				$translation->setLanguage(null);
			}
		}

		return $this;
	}
}

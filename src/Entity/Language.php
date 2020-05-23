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
	 * @ORM\Column(type="text")
	 */
	private $name;

	/**
	 * @ORM\ManyToMany(targetEntity=Book::class, mappedBy="languages")
	 */
	private $books;

	/**
	 * @ORM\OneToMany(targetEntity=Reading::class, mappedBy="language", orphanRemoval=true)
	 */
	private $readings;

	public function __construct()
	{
		$this->books = new ArrayCollection();
		$this->readings = new ArrayCollection();
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
	 * @return Collection|Book[]
	 */
	public function getBooks(): Collection
	{
		return $this->books;
	}

	public function addBook(Book $book): self
	{
		if (!$this->books->contains($book)) {
			$this->books[] = $book;
			$book->addLanguage($this);
		}

		return $this;
	}

	public function removeBook(Book $book): self
	{
		if ($this->books->contains($book)) {
			$this->books->removeElement($book);
			$book->removeLanguage($this);
		}

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
}

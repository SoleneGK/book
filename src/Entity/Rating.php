<?php

namespace App\Entity;

use App\Repository\RatingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RatingRepository::class)
 */
class Rating
{
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="integer")
	 */
	private $value;

	/**
	 * @ORM\Column(type="text")
	 */
	private $code;

	/**
	 * @ORM\OneToMany(targetEntity=Book::class, mappedBy="rating")
	 */
	private $books;

	public function __construct()
	{
		$this->books = new ArrayCollection();
	}

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getValue(): ?int
	{
		return $this->value;
	}

	public function setValue(int $value): self
	{
		$this->value = $value;

		return $this;
	}

	public function getCode(): ?string
	{
		return $this->code;
	}

	public function setCode(string $code): self
	{
		$this->code = $code;

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
			$book->setRating($this);
		}

		return $this;
	}

	public function removeBook(Book $book): self
	{
		if ($this->books->contains($book)) {
			$this->books->removeElement($book);
			// set the owning side to null (unless already changed)
			if ($book->getRating() === $this) {
				$book->setRating(null);
			}
		}

		return $this;
	}
}

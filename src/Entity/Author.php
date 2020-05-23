<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AuthorRepository::class)
 */
class Author
{
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $first_name;

	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $middle_name;

	/**
	 * @ORM\Column(type="text")
	 */
	private $last_name;

	/**
	 * @ORM\ManyToMany(targetEntity=Book::class, mappedBy="authors")
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

	public function getFirstName(): ?string
	{
		return $this->first_name;
	}

	public function setFirstName(?string $first_name): self
	{
		$this->first_name = $first_name;

		return $this;
	}

	public function getMiddleName(): ?string
	{
		return $this->middle_name;
	}

	public function setMiddleName(?string $middle_name): self
	{
		$this->middle_name = $middle_name;

		return $this;
	}

	public function getLastName(): ?string
	{
		return $this->last_name;
	}

	public function setLastName(string $last_name): self
	{
		$this->last_name = $last_name;

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
			$book->addAuthor($this);
		}

		return $this;
	}

	public function removeBook(Book $book): self
	{
		if ($this->books->contains($book)) {
			$this->books->removeElement($book);
			$book->removeAuthor($this);
		}

		return $this;
	}

	public function __toString()
	{
		$string = '';

		if (!\is_null($this->first_name))
		{
			$string .= $this->first_name . ' ';
		}

		if (!\is_null($this->middle_name))
		{
			$string .= $this->middle_name . ' ';
		}

		$string .= $this->last_name;

		return $string;
	}
}

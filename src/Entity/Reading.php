<?php

namespace App\Entity;

use App\Repository\ReadingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReadingRepository::class)
 */
class Reading
{
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="date")
	 */
	private $start_date;

	/**
	 * @ORM\Column(type="date", nullable=true)
	 */
	private $end_date;

	/**
	 * @ORM\ManyToOne(targetEntity=Book::class, inversedBy="readings")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $book;

	/**
	 * @ORM\ManyToOne(targetEntity=Language::class, inversedBy="readings")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $language;

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getStartDate(): ?\DateTimeInterface
	{
		return $this->start_date;
	}

	public function setStartDate(\DateTimeInterface $start_date): self
	{
		$this->start_date = $start_date;

		return $this;
	}

	public function getEndDate(): ?\DateTimeInterface
	{
		return $this->end_date;
	}

	public function setEndDate(?\DateTimeInterface $end_date): self
	{
		$this->end_date = $end_date;

		return $this;
	}

	public function getBook(): ?Book
	{
		return $this->book;
	}

	public function setBook(?Book $book): self
	{
		$this->book = $book;

		return $this;
	}

	public function getLanguage(): ?Language
	{
		return $this->language;
	}

	public function setLanguage(?Language $language): self
	{
		$this->language = $language;

		return $this;
	}
}

<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
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
	private $title;

	/**
	 * @ORM\ManyToMany(targetEntity=Author::class, inversedBy="books")
	 */
	private $authors;

	/**
	 * @ORM\ManyToMany(targetEntity=Genre::class, inversedBy="books")
	 */
	private $genres;

	/**
	 * @ORM\ManyToOne(targetEntity=Rating::class, inversedBy="books")
	 */
	private $rating;

	/**
	 * @ORM\OneToMany(targetEntity=Reading::class, mappedBy="book", orphanRemoval=true)
	 */
	private $readings;

	/**
	 * @ORM\ManyToMany(targetEntity=Language::class, inversedBy="books")
	 */
	private $languages;

    /**
     * @ORM\ManyToOne(targetEntity=Series::class, inversedBy="books")
     */
    private $series;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number_in_series;

	public function __construct()
	{
		$this->authors = new ArrayCollection();
		$this->genres = new ArrayCollection();
		$this->readings = new ArrayCollection();
		$this->languages = new ArrayCollection();
	}

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getTitle(): ?string
	{
		return $this->title;
	}

	public function setTitle(string $title): self
	{
		$this->title = $title;
	
		return $this;
	}

	/**
	 * @return Collection|Author[]
	 */
	public function getAuthors(): Collection
	{
		return $this->authors;
	}

	public function addAuthor(Author $author): self
	{
		if (!$this->authors->contains($author)) {
			$this->authors[] = $author;
		}
	
		return $this;
	}

	public function removeAuthor(Author $author): self
	{
		if ($this->authors->contains($author)) {
			$this->authors->removeElement($author);
		}
	
		return $this;
	}

	/**
	 * @return Collection|Genre[]
	 */
	public function getGenres(): Collection
	{
		return $this->genres;
	}

	public function addGenre(Genre $genre): self
	{
		if (!$this->genres->contains($genre)) {
			$this->genres[] = $genre;
		}
	
		return $this;
	}

	public function removeGenre(Genre $genre): self
	{
		if ($this->genres->contains($genre)) {
			$this->genres->removeElement($genre);
		}
	
		return $this;
	}

	public function getRating(): ?Rating
	{
		return $this->rating;
	}

	public function setRating(?Rating $rating): self
	{
		$this->rating = $rating;
	
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
			$reading->setBook($this);
		}
	
		return $this;
	}

	public function removeReading(Reading $reading): self
	{
		if ($this->readings->contains($reading)) {
			$this->readings->removeElement($reading);
			// set the owning side to null (unless already changed)
			if ($reading->getBook() === $this) {
				$reading->setBook(null);
			}
		}
	
		return $this;
	}

	/**
	 * @return Collection|Language[]
	 */
	public function getLanguages(): Collection
	{
		return $this->languages;
	}

	public function addLanguage(Language $language): self
	{
		if (!$this->languages->contains($language)) {
			$this->languages[] = $language;
		}
	
		return $this;
	}

	public function removeLanguage(Language $language): self
	{
		if ($this->languages->contains($language)) {
			$this->languages->removeElement($language);
		}
	
		return $this;
	}

	public function __toString()
	{
		return $this->title;
	}

    public function getSeries(): ?Series
    {
        return $this->series;
    }

    public function setSeries(?Series $series): self
    {
        $this->series = $series;

        return $this;
    }

    public function getNumberInSeries(): ?int
    {
        return $this->number_in_series;
    }

    public function setNumberInSeries(?int $number_in_series): self
    {
        $this->number_in_series = $number_in_series;

        return $this;
    }
}

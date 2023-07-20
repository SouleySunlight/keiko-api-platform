<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\State\AdditionDateStateProcessor;
use App\State\ReadingTimeStateProvider;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity()]
#[ApiResource(
    operations:[
    new Get(),
    new GetCollection(normalizationContext: ["groups" => [self::READ_BOOKS]], provider:ReadingTimeStateProvider::class),
    new GetCollection(uriTemplate:"books-titles", normalizationContext: ["groups" => [self::READ_BOOKS_TITLES]]),
    new Post(uriTemplate:'create-book-with-author', processor:AdditionDateStateProcessor::class, denormalizationContext: ["groups" => [self::CREATE_BOOKS_WITH_AUTHOR]], normalizationContext: ["groups" => [self::READ_BOOKS]]),
    new Post()
     ]
     )]
class Book
{
    public final const READ_BOOKS = "READ_BOOKS";
    public final const READ_BOOKS_TITLES = "READ_BOOKS_TITLE";
    public final const CREATE_BOOKS_WITH_AUTHOR = "CREATE_BOOKS_WITH_AUTHOR";

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups([self::READ_BOOKS])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups([self::READ_BOOKS_TITLES, self::READ_BOOKS, self::CREATE_BOOKS_WITH_AUTHOR])]
    private ?string $frenchTitle = null;


    #[ORM\Column(length: 255)]
    #[Groups([self::READ_BOOKS_TITLES, self::READ_BOOKS, self::CREATE_BOOKS_WITH_AUTHOR])]
    private ?string $originalTitle = null;

    #[ORM\Column(nullable: true)]
    #[Groups([self::READ_BOOKS, self::CREATE_BOOKS_WITH_AUTHOR])]
    private ?int $pageCount = null;

    #[ORM\ManyToOne(targetEntity: Author::class, cascade: ['persist'])]
    #[ORM\JoinTable(false)]
    #[Groups([self::READ_BOOKS, self::CREATE_BOOKS_WITH_AUTHOR])]
    private ?Author $author = null;

    #[Groups([self::READ_BOOKS])]
    private ?int $readingTime = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    #[Groups([self::READ_BOOKS])]
    private ?DateTime $additionDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFrenchTitle(): ?string
    {
        return $this->frenchTitle;
    }

    public function setFrenchTitle(?string $frenchTitle): self
    {
        $this->frenchTitle = $frenchTitle;

        return $this;
    }

    public function getOriginalTitle(): ?string
    {
        return $this->originalTitle;
    }

    public function setOriginalTitle($originalTitle): self
    {
        $this->originalTitle = $originalTitle;

        return $this;
    }

    public function getPageCount(): ?int
    {
        return $this->pageCount;
    }

    public function setPageCount(?int $pageCount): self
    {
        $this->pageCount = $pageCount;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor($author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getReadingTime(): ?int
    {
        return $this->readingTime;
    }

    public function setReadingTime(?int $readingTime): self
    {
        $this->readingTime = $readingTime;

        return $this;
    }

    public function getAdditionDate(): ?DateTime
    {
        return $this->additionDate;
    }


    public function setAdditionDate(?DateTime $additionDate): self
    {
        $this->additionDate = $additionDate;

        return $this;
    }
}

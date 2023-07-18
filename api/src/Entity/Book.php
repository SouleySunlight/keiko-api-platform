<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity()]
#[ApiResource(
    operations:[
    new Get(),
    new GetCollection(),
    new GetCollection(uriTemplate:"books-titles", normalizationContext: ["groups" => [self::READ_BOOKS_TITLES]]),
    new Post()
     ]
     )]
class Book
{

    public final const READ_BOOKS_TITLES = "READ_BOOKS_TITLE"; 

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(self::READ_BOOKS_TITLES)]
    private ?string $frenchTitle = null;


    #[ORM\Column(length: 255)]
    #[Groups(self::READ_BOOKS_TITLES)]
    private ?string $originalTitle = null;

    #[ORM\Column(nullable: true)]
    private ?int $pageCount = null;

    #[ORM\ManyToOne(targetEntity: Author::class)]
    #[ORM\JoinTable(false)]
    private ?Author $author = null;

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
}

<?php

namespace App\Entity;

use App\Repository\NotesRepository;
use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: NotesRepository::class)]
#[ApiResource
(
    collectionOperations: [
        'get' => ['method' => 'get'],
        'post' => ['method' => 'post'],
        // 'noteBook'=> ['method'=> 'get', 'controller'=>NoteController::class, 'path'=> '/noteBook']
    ],
    itemOperations: [
        'get' => ['method' => 'get' ,'requirements' => ['id' => '\d+'],],
        'put' => ['method' => 'put',],
        'delete' => ['method' => 'delete']
    ],
)
]

class Notes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $week = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 1600)]
    private ?string $text = null;

    #[ORM\Column(length: 1600, nullable: true)]
    private ?string $image = null;

    #[ORM\ManyToOne(targetEntity : Book::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Book $book = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWeek(): ?string
    {
        return $this->week;
    }

    public function setWeek(string $week): self
    {
        $this->week = $week;

        return $this;
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

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

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
}

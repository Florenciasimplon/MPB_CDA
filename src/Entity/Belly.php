<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\BellyController;
use App\Repository\BellyRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BellyRepository::class)]
#[ApiResource
(
    collectionOperations: [
        'get' => ['method' => 'get'],
        'post' => ['method' => 'post'],
        'userBelly'=> ['method'=> 'get', 'controller'=>BellyController::class, 'path'=> '/userBelly']
    ],
    itemOperations: [
        'get' => ['method' => 'get' ,'requirements' => ['id' => '\d+'],],
        'put' => ['method' => 'put',],
        'delete' => ['method' => 'delete']
    ],
)
]
class Belly
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 1600, nullable: true)]
    private ?string $picture = null;

    #[ORM\Column(length: 2)]
    private ?string $month = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $textPicture = null;

    #[ORM\ManyToOne(inversedBy: 'belly')]
    private ?UserAuthentication $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getMonth(): ?string
    {
        return $this->month;
    }

    public function setMonth(string $month): self
    {
        $this->month = $month;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTextPicture(): ?string
    {
        return $this->textPicture;
    }

    public function setTextPicture(?string $textPicture): self
    {
        $this->textPicture = $textPicture;

        return $this;
    }

    public function getUser(): ?UserAuthentication
    {
        return $this->user;
    }

    public function setUser(?UserAuthentication $user): self
    {
        $this->user = $user;

        return $this;
    }
}

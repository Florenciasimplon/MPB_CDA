<?php

namespace App\Entity;

use App\Repository\BookRepository;
use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\NoteController;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: BookRepository::class)]
#[ApiResource
(
    collectionOperations: [
        'get' => ['method' => 'get'],
        'post' => ['method' => 'post'],
        'BookNote'=> ['method'=> 'get', 'controller'=>NoteController::class, 'path'=> '/BookNote']
    ],
    itemOperations: [
        'get' => ['method' => 'get' ,'requirements' => ['id' => '\d+'],],
        'put' => ['method' => 'put',],
        'delete' => ['method' => 'delete']
    ],
)
]


class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(length: 255)]
    private ?string $nameBook = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $creationDate = null;

    #[ORM\ManyToOne(targetEntity : UserAuthentication::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?UserAuthentication $user = null;

    #[ORM\OneToMany(mappedBy: 'book', targetEntity: Notes::class)]
    private Collection $notes;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
        $this->note = new ArrayCollection();
    }

 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameBook(): ?string
    {
        return $this->nameBook;
    }

    public function setNameBook(string $nameBook): self
    {
        $this->nameBook = $nameBook;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(?\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

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

    /**
     * @return Collection<int, Notes>
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Notes $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes->add($note);
            $note->setBook($this);
        }

        return $this;
    }

    public function removeNote(Notes $note): self
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getBook() === $this) {
                $note->setBook(null);
            }
        }

        return $this;
    }

}

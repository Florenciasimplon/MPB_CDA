<?php

namespace App\Entity;

use App\Repository\UserAuthenticationRepository;
use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\LoginController;
use App\Controller\MeController;
use App\Controller\UserBooksController;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Lcobucci\JWT\Signer\None;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints\IsNull;

#[ORM\Entity(repositoryClass: UserAuthenticationRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get' => ['method' => 'get'],
        'post' => ['method' => 'post'],
        'dashboard'=> ['method'=> 'get', 'controller'=>LoginController::class, 'path'=> '/dashboard'],
        'userBooks'=> ['method'=> 'get', 'controller'=>UserBooksController::class, 'path'=> '/userBooks'],
        
    ],
    itemOperations: [
        'get' => ['method' => 'get', 'requirements' => ['id' => '\d+'],],
        'put' => ['method' => 'put'],
        'delete' => ['method' => 'delete']
    ],
   
)]
class UserAuthentication implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ApiProperty(
        attributes: [
            "openapi_context" => [
                "type" => "string",
                "example" => "password",
            ],
        ],
    )]
    private $plainPassword;

    #[ORM\Column(length: 255)]
    private ?string $userName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Book::class)]
    private Collection $book;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Belly::class)]
    private Collection $belly;

    

    public function __construct()
    {
        // $this->books = new ArrayCollection();
        $this->book = new ArrayCollection();
        $this->belly = new ArrayCollection();
    }
    
   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword(): string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }
    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): self
    {
        $this->userName = $userName;

        return $this;
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

    /**
     * @return Collection<int, Book>
     */
    public function getBook(): Collection
    {
        return $this->book;
    }

    public function addBook(Book $book): self
    {
        if (!$this->book->contains($book)) {
            $this->book->add($book);
            $book->setUser($this);
        }

        return $this;
    }

    public function removeBook(Book $book): self
    {
        if ($this->book->removeElement($book)) {
            // set the owning side to null (unless already changed)
            if ($book->getUser() === $this) {
                $book->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Belly>
     */
    public function getBelly(): Collection
    {
        return $this->belly;
    }

    public function addBelly(Belly $belly): self
    {
        if (!$this->belly->contains($belly)) {
            $this->belly->add($belly);
            $belly->setUser($this);
        }

        return $this;
    }

    public function removeBelly(Belly $belly): self
    {
        if ($this->belly->removeElement($belly)) {
            // set the owning side to null (unless already changed)
            if ($belly->getUser() === $this) {
                $belly->setUser(null);
            }
        }

        return $this;
    }

   

    
}

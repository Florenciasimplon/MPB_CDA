<?php

namespace App\Entity;
use App\Repository\ArticleRepository;
use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ApiResource
(
    collectionOperations: [
        'get' => ['method' => 'get'],
        'post' => ['method' => 'post'],
    ],
    itemOperations: [
        'get' => ['method' => 'get', 'requirements' => ['id' => '\d+'],],
        'put' => ['method' => 'put'],
        'delete' => ['method' => 'delete']
    ],
)
]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 2000)]
    private ?string $text = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $pictureArticle = null;

    #[ORM\ManyToOne(targetEntity : CategoryArticle::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?CategoryArticle $category = null;

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

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getPictureArticle(): ?string
    {
        return $this->pictureArticle;
    }

    public function setPictureArticle(?string $pictureArticle): self
    {
        $this->pictureArticle = $pictureArticle;

        return $this;
    }

    public function getCategory(): ?CategoryArticle
    {
        return $this->category;
    }

    public function setCategory(?CategoryArticle $category): self
    {
        $this->category = $category;

        return $this;
    }
}

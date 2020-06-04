<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToMany(targetEntity=Article::class, inversedBy="Categories")
     */
    private $Articles;

    public function __construct()
    {
        $this->Articles = new ArrayCollection();
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
     * @return Collection|article[]
     */
    public function getArticles(): Collection
    {
        return $this->Articles;
    }

    public function addArticle(article $article): self
    {
        if (!$this->Articles->contains($article)) {
            $this->Articles[] = $article;
        }

        return $this;
    }

    public function removeArticle(article $article): self
    {
        if ($this->Articles->contains($article)) {
            $this->Articles->removeElement($article);
        }

        return $this;
    }
}

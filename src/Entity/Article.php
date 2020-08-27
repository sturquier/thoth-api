<?php

namespace App\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 * @UniqueEntity("url")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @JMS\Groups({"getArticles", "getMyFavorites"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @JMS\Groups({"getArticles", "getMyFavorites"})
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @JMS\Groups({"getArticles", "getMyFavorites"})
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     * @JMS\Groups({"getArticles", "getMyFavorites"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     * @JMS\Groups({"getArticles", "getMyFavorites"})
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @JMS\Groups({"getArticles", "getMyFavorites"})
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Website", inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     * @JMS\Groups({"getArticles", "getMyFavorites"})
     */
    private $website;

    public function __construct($title, $description, $createdAt, $url, $image)
    {
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setCreatedAt($createdAt);
        $this->setUrl($url);
        $this->setImage($image);
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

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

    public function getWebsite(): ?Website
    {
        return $this->website;
    }

    public function setWebsite(?Website $website): self
    {
        $this->website = $website;

        return $this;
    }
}

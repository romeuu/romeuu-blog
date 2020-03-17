<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BlogPostRepository")
 */
class BlogPost
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
     * @ORM\Column(type="string", length=190, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="datetime")
     */
    private $regDate;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BlogUser", inversedBy="BlogPost")
     */
    protected $user;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getRegDate(): ?\DateTimeInterface
    {
        return $this->regDate;
    }

    public function setRegDate(\DateTimeInterface $regDate): self
    {
        $this->regDate = $regDate;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUser(): ?BlogUser
    {
        return $this->user;
    }

    public function setUser(?BlogUser $user): self
    {
        $this->user = $user;

        return $this;
    }
}

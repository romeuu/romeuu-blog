<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BlogCommentsRepository")
 */
class BlogComments
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @ORM\Column(type="datetime")
     */
    private $regDate;

    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BlogUser", inversedBy="comments")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BlogPost", inversedBy="comments")
     */
    protected $post;

    public function getRegDate(): ?\DateTimeInterface
    {
        return $this->regDate;
    }

    public function setRegDate(\DateTimeInterface $regDate): self
    {
        $this->regDate = $regDate;

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

    public function getPost(): ?BlogPost
    {
        return $this->post;
    }

    public function setPost(?BlogPost $post): self
    {
        $this->post = $post;

        return $this;
    }
}

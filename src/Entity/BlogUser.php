<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\BlogUserRepository")
 */
class BlogUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Email(groups={"registration"})
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @Assert\NotBlank(groups={"registration"})
     * @Assert\Length(min=7, groups={"registration"})
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @Assert\Length(min=2)
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BlogPost", mappedBy="user")
    */
    protected $posts;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BlogComments", mappedBy="user")
    */
    protected $comments;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function __construct(){
        $this->posts = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    /**
     * @return Collection|BlogPost[]
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(BlogPost $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setUser($this);
        }

        return $this;
    }

    public function removePost(BlogPost $post): self
    {
        if ($this->posts->contains($post)) {
            $this->posts->removeElement($post);
            // set the owning side to null (unless already changed)
            if ($post->getUser() === $this) {
                $post->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|BlogComments[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(BlogComments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(BlogComments $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
            }
        }

        return $this;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }
}

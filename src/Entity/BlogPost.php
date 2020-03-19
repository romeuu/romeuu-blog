<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use \stdClass;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BlogPostRepository")
 * @ORM\HasLifecycleCallbacks()
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
     * @Assert\NotBlank
     * @Assert\Length(max= "255")
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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modDate;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(groups={"edit"})
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BlogUser", inversedBy="posts")
     */
    protected $user;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\BlogCategory", inversedBy="posts")
    */
    protected $categories;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BlogComments", mappedBy="post")
    */
    protected $comments;

    public function __construct(){
        $this->categories = new ArrayCollection();
        $this->comments = new ArrayCollection();
        
        $this->regDate = new \DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function setModificationDate()
    {
        $this->modDate = new \DateTime();
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

    /**
     * @return Collection|BlogCategory[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(BlogCategory $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(BlogCategory $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
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
            $comment->setPost($this);
        }

        return $this;
    }

    public function removeComment(BlogComments $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getPost() === $this) {
                $comment->setPost(null);
            }
        }

        return $this;
    }

    public function getModDate(): ?\DateTimeInterface
    {
        return $this->modDate;
    }

    public function setModDate(\DateTimeInterface $modDate): self
    {
        $this->modDate = $modDate;

        return $this;
    }
}

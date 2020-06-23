<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    const ROLE = [
        0 => 'Administrateur',
        1 => 'client'
    ];
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message="Veuillez renseigner l'adresse mail'"
     * )
     * @Assert\Regex(
     *     pattern="/^[\s\w\#\_\-éèàçâêîôûùäaëïüö\.\@]+$/",
     *     message="Caractère(s) non valide(s)"
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message="Veuillez renseigner le mot de passe"
     * )
     * @Assert\Regex(
     *     pattern="/^[\s\w\#\_\-éèàçâêîôûùäaëïüö]+$/",
     *     message="Caractère(s) non valide(s)"
     * )
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $role;

    /**
     * @ORM\OneToMany(targetEntity=Comments::class, mappedBy="id_user", orphanRemoval=true)
     */
    private $comments;


    public function __construct()
    {
        $this->comments = new ArrayCollection();
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles()
    {
        if ($this->role == "administrateur")
            return ["ROLE_ADMIN"];
        if ($this->role == "client")
            return ["ROLE_USER"];
        return [];
    }

    public function getSalt()
    {
        return "";
    }

    public function getUsername()
    {
        return $this->getEmail();
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $role = 'client';
        $this->role = $role;
        return $this;
    }

    /**
     * @return Collection|Comments[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setIdUser($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getIdUser() === $this) {
                $comment->setIdUser(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getEmail();
    }

}

<?php

namespace App\Entity;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CommentsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CommentsRepository::class)
 * @ApiResource(
 *     normalizationContext={
 *     "groups"={"read:comment"},
 *     },
 *     attributes={
 *     "order"={"date":"DESC"}
 *     }
 * )
 * @ApiFilter(SearchFilter::class, properties={"id_product": "exact"})
 *
 */
class Comments
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"read:comment"})
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Groups({"read:comment"})
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read:comment"})
     */
    private $date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"read:comment"})
     */
    private $date_update;

    /**
     * @ORM\ManyToOne(targetEntity=Products::class, inversedBy="coments")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read:comment"})
     */
    private $id_product;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read:comment"})
     */
    private $id_user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDateUpdate(): ?\DateTimeInterface
    {
        return $this->date_update;
    }

    public function setDateUpdate(?\DateTimeInterface $date_update): self
    {
        $this->date_update = $date_update;

        return $this;
    }

    public function getIdProduct(): ?Products
    {
        return $this->id_product;
    }

    public function setIdProduct(?Products $id_product): self
    {
        $this->id_product = $id_product;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(?User $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }
}

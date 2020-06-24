<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommentsRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity(repositoryClass=CommentsRepository::class)
 * @ApiResource(
 *     normalizationContext={
 *     "groups"={"read:comment"},
 *     "enable_max_depth"=true
 *     },
 *     attributes={
 *     "order"={"date":"DESC"}
 *     },
 *     paginationItemsPerPage=2,
 *     itemOperations={
 *      "get"={
 *          "normalization_context"={"groups"={"read:comment", "read:comment:full"}}
 *     },
 *      "put"={
 *"security"="is_granted('EDIT_COMMENT', object)",
 *     "denormalization_context"={"groups"="update:comment"}
 *     },
 *     "delete"={
 * "security"="is_granted('EDIT_COMMENT', object)"
 *     }
 *     },
 *     collectionOperations={
 *       "post"={
 *          "normalization_context"={"groups"={"read:comment", "read:comment:full"}},
 *          "denormalization_context"={"groups"="create:comment"},
 *          "security"="is_granted('EDIT_COMMENT', object)",
 *          "controller"=App\Controller\Api\CommentCreateController::class
 *     },
 *       "get"={
 *          "normalization_context"={"groups"={"read:comment", "read:comment:full"}},
 *     }
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
     * @Groups({"read:comment", "create:comment", "update:comment"})
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
     * @ORM\ManyToOne(targetEntity=Products::class, inversedBy="comments")
     * @ORM\JoinColumn(name="id_product_id", referencedColumnName="id", nullable=false)
     * @Groups({"read:comment:full", "create:comment"})
     * @MaxDepth(1)
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="comments")
     * @ORM\JoinColumn(name="id_user_id", referencedColumnName="id", nullable=false)
     * @Groups({"read:comment"})
     * @MaxDepth(1)
     */
    private $user;

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

    public function getProduct(): ?Products
    {
        return $this->product;
    }

    public function setProduct(?Products $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}

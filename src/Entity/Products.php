<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductsRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ProductsRepository::class)
 * @ApiResource(
 *     collectionOperations={},
 *     itemOperations={
 *      "get"={
 *        "controller"=App\Controller\Api\EmptyController::class,
 *      "read"=false,
 *      "deserialize"=false
 *          }
 *     }
 * )
 *
 */
class Products
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     * @Groups({"read:comment"})
     */
    private $ProductName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $CategoryId;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $QuantityPerUnit;

    /**
     * @ORM\Column(type="float")
     */
    private $UnitPrice;

    /**
     * @ORM\Column(type="integer")
     */
    private $UnitsInStock;

    /**
     * @ORM\Column(type="integer")
     */
    private $UnitsOnOrder;

    /**
     * @ORM\Column(type="integer")
     */
    private $RedorderLevel;

    /**
     * @ORM\Column(type="integer")
     */
    private $Discontinued;

    /**
     * @ORM\ManyToOne(targetEntity=Suppliers::class, inversedBy="products")
     */
    private $SupplierID;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Comments::class, mappedBy="product", orphanRemoval=true)
     */
    private $comments;

    public function __construct()
    {
        $this->coments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->ProductName;
    }

    public function setProductName(string $ProductName): self
    {
        $this->ProductName = $ProductName;

        return $this;
    }

    public function getSupplierID(): ?Suppliers
    {
        return $this->SupplierID;
    }

    public function setSupplierID(?Suppliers $SupplierId): self
    {
        $this->SupplierID = $SupplierId;

        return $this;
    }

    public function getCategoryId(): ?int
    {
        return $this->CategoryId;
    }

    public function setCategoryId(?int $CategoryId): self
    {
        $this->CategoryId = $CategoryId;

        return $this;
    }

    public function getQuantityPerUnit(): ?string
    {
        return $this->QuantityPerUnit;
    }

    public function setQuantityPerUnit(?string $QuantityPerUnit): self
    {
        $this->QuantityPerUnit = $QuantityPerUnit;

        return $this;
    }

    public function getUnitPrice(): ?float
    {
        return $this->UnitPrice;
    }

    public function setUnitPrice(float $UnitPrice): self
    {
        $this->UnitPrice = $UnitPrice;

        return $this;
    }

    public function getUnitsInStock(): ?int
    {
        return $this->UnitsInStock;
    }

    public function setUnitsInStock(int $UnitsInStock): self
    {
        $this->UnitsInStock = $UnitsInStock;

        return $this;
    }

    public function getUnitsOnOrder(): ?int
    {
        return $this->UnitsOnOrder;
    }

    public function setUnitsOnOrder(int $UnitsOnOrder): self
    {
        $this->UnitsOnOrder = $UnitsOnOrder;

        return $this;
    }

    public function getRedorderLevel(): ?int
    {
        return $this->RedorderLevel;
    }

    public function setRedorderLevel(int $RedorderLevel): self
    {
        $this->RedorderLevel = $RedorderLevel;

        return $this;
    }

    public function getDiscontinued(): ?int
    {
        return $this->Discontinued;
    }

    public function setDiscontinued(int $Discontinued): self
    {
        $this->Discontinued = $Discontinued;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

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
            $comment->setIdProduct($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getIdProduct() === $this) {
                $comment->setIdProduct(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getProductName();
    }
}

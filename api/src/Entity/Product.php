<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A product to sell on our website.
 *
 * @ApiResource(
 *     normalizationContext={"groups"="product:item"},
 *     denormalizationContext={"groups"="product:item"},
 *     itemOperations={
 *       "get",
 *       "put"
 *     },
 *     collectionOperations={
 *       "get"={"normalization_context"={"groups"="product:list"}},
 *       "post"
 *     }
 * )
 * @ORM\Entity
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public ?int $id = null;

    /**
     * @var string The name of the product
     *
     * @ORM\Column(length=255)
     * @Assert\NotBlank
     *
     * @Groups({"product:list", "product:item"})
     */
    public string $name = '';

    /**
     * @var string The price of the product.
     *
     * @ORM\Column(type="decimal", scale=2, precision=10)
     * @Assert\Regex("/^[0-9]+\.[0-9]{2}$/", message="The price must have the format: 10.00")
     *
     * @Groups("product:item")
     */
    public string $price = '';

    /**
     * @ORM\ManyToOne(targetEntity=Brand::class, inversedBy="products", cascade={"persist"})
     *
     * @Groups({"product:list", "product:item"})
     */
    private $brand;

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A product to sell on our website.
 *
 * @ApiResource
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
     * @ORM\Column
     */
    public string $name = '';

    /**
     * @var string The price of the product.
     *
     * @ORM\Column(type="decimal", scale=2, precision=10)
     */
    public string $price = '';
}

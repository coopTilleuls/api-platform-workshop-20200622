<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * A product to sell on our website.
 *
 * @ApiResource
 */
class Product
{
    /**
     * @var int The identifier of the product.
     *
     * @ApiProperty(identifier=true)
     */
    public ?int $id = null;

    /**
     * @var string The name of the product
     */
    public string $name;

    /**
     * @var string The price of the product.
     */
    public string $price;
}

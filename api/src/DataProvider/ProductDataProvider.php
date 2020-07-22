<?php
declare(strict_types=1);

namespace App\DataProvider;


use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\Entity\Product;

final class ProductDataProvider
    implements ContextAwareCollectionDataProviderInterface, ItemDataProviderInterface, RestrictedDataProviderInterface
{
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    private function getDb(): array
    {
        if (!file_exists($this->path)) {
            return ['products' => []];
        }

        $rawData = file_get_contents($this->path);
        return unserialize($rawData);
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = [])
    {
        return $this->getDb()['products'];
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        return $this->getDb()['products'][$id] ?? null;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return $resourceClass === Product::class;
    }
}

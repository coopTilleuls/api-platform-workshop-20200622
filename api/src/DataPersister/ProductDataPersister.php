<?php
declare(strict_types=1);

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Product;

final class ProductDataPersister implements ContextAwareDataPersisterInterface
{
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Product;
    }

    /**
     * @param Product $data
     */
    public function persist($data, array $context = [])
    {
        // FIXME: handle locks
        if (file_exists($this->path)) {
            $rawData = file_get_contents($this->path);
            // [$id => $object]
            $db = unserialize($rawData);
        } else {
            $db = [
                'offset' => 0,
                'products' => [],
            ];
        }

        if ($data->id === null) {
            $data->id = ++$db['offset'];
        }

        $db['products'][$data->id] = $data;

        file_put_contents($this->path, serialize($db));

        return $data;
    }

    public function remove($data, array $context = [])
    {
    }
}

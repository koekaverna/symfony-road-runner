<?php

declare(strict_types=1);

namespace App\Controller;

use Spiral\RoadRunner\KeyValue\StorageInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Example controller that show difference between key-value storage
 * and Service property. Service instance persists in worker,
 * kv-storage is shared
 */
#[Route]
#[AsController]
class TestController
{
    private int $counter = 0;

    public function __invoke(StorageInterface $storage): JsonResponse
    {
        $memory = (int) $storage->get('test');

        try {
            return new JsonResponse([
                'memory_storage' => $memory,
                'class_counter' => $this->counter,
            ]);
        } finally {
            $storage->set('test', ++$memory);
            ++$this->counter;
        }
    }
}

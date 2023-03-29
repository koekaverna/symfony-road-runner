<?php

declare(strict_types=1);

namespace App\Task;

use Spiral\RoadRunner\KeyValue\StorageInterface;

final class RequestLoggerTask implements TaskInterface
{
    public function __construct(
        private readonly StorageInterface $storage,
    ) {
    }

    /**
     * It's just an example. It would not work correctly with many simultaneous
     * connection because there is no lock mechanism on getting counter.
     */
    public function __invoke(string $uri, string $method, string $content): void
    {
        // add some delay
        sleep(1);

        // Randomly fail job to test retry
        if(mt_rand(0, 3) !== 0) {
            throw new \Exception('Task failed for testing purpose.');
        }

        $counter = (int) $this->storage->get('proxy_request_counter');
        $this->storage->setMultiple([
            "proxy_request_data_uri_{$counter}" => $uri,
            "proxy_request_data_method_{$counter}" => $method,
            "proxy_request_data_content_{$counter}" => $content,
        ]);

        $this->storage->set('proxy_request_counter', ++$counter);
    }

    public function isRetryOnFail(): bool
    {
        return true;
    }
}

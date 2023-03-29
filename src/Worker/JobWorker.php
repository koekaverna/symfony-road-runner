<?php

declare(strict_types=1);

namespace App\Worker;

use App\Task\TaskInterface;
use Baldinof\RoadRunnerBundle\Worker\WorkerInterface;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Spiral\RoadRunner\Jobs\ConsumerInterface;

final class JobWorker implements WorkerInterface
{
    public function __construct(
        private readonly ContainerInterface $locator,
        private readonly ConsumerInterface $consumer,
        private readonly LoggerInterface $logger,
    ) {
    }

    public function start(): void
    {
        while ($task = $this->consumer->waitTask()) {
            try {
                $this->logger->debug(sprintf('Starting task "%s"', $task->getName()));
                /** @var TaskInterface|callable $handler */
                $handler = $this->locator->get($task->getName());
                $handler(...$task->getPayload());

                $task->complete();
                $this->logger->debug(sprintf('Task "%s" completed', $task->getName()));
            } catch (\Throwable $exception) {
                $this->logger->warning(sprintf('Task "%s" failed', $task->getName()), [
                    'retry-on-fail' => $handler->isRetryOnFail(),
                    'exception' => [
                        'message' => $exception->getMessage(),
                        'file' => $exception->getFile(),
                        'trace' => $exception->getTrace(),
                    ],
                ]);
                $task->fail($exception, $handler->isRetryOnFail());
            }
        }
    }
}

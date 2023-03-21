<?php

declare(strict_types=1);

namespace App\Temporal\Worker;

use Baldinof\RoadRunnerBundle\Worker\WorkerInterface;
use Temporal\Worker\WorkerFactoryInterface;

final class TemporalWorker implements WorkerInterface
{
    /**
     * @param iterable<class-string> $workflows
     * @param iterable<object> $activities
     * @param WorkerFactoryInterface $factory
     */
    public function __construct(
        private readonly iterable $workflows,
        private readonly iterable $activities,
        private readonly WorkerFactoryInterface $factory,
    ) {
    }

    public function start(): void
    {
        $worker = $this->factory->newWorker();
        $worker->registerWorkflowTypes(...$this->workflows);
        $worker->registerActivityImplementations(...$this->activities);
        $this->factory->run();
    }
}

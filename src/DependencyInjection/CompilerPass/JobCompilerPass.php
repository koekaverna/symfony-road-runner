<?php

declare(strict_types=1);

namespace App\DependencyInjection\CompilerPass;

use App\Worker\JobWorker;
use Baldinof\RoadRunnerBundle\Worker\WorkerRegistryInterface;
use Spiral\RoadRunner\Environment;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

final class JobCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $provider = $container->findDefinition(WorkerRegistryInterface::class);
        $provider->addMethodCall('registerWorker', [Environment\Mode::MODE_JOBS, new Reference(JobWorker::class)]);
    }
}

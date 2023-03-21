<?php

declare(strict_types=1);

namespace App\DependencyInjection\CompilerPass;

use App\Temporal\Worker\TemporalWorker;
use Baldinof\RoadRunnerBundle\Worker\WorkerRegistryInterface;
use Spiral\RoadRunner\Environment;
use Symfony\Component\DependencyInjection\ChildDefinition;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Temporal\Activity\ActivityInterface;

final class TemporalCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $provider = $container->findDefinition(WorkerRegistryInterface::class);
        $provider->addMethodCall('registerWorker', [Environment\Mode::MODE_TEMPORAL, new Reference(TemporalWorker::class)]);

        // Register activities
        $container->registerAttributeForAutoconfiguration(ActivityInterface::class, static function(ChildDefinition $definition, ActivityInterface $attribute): void {
            $definition->addTag('app.temporal.activity');
        });
    }
}

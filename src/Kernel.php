<?php

namespace App;

use App\DependencyInjection\CompilerPass\TemporalCompilerPass;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    protected function build(ContainerBuilder $container)
    {
        // Should run before AttributeAutoconfigurationPass to add tagged Activities
        $container->addCompilerPass(new TemporalCompilerPass(), PassConfig::TYPE_BEFORE_OPTIMIZATION, 110);
    }
}

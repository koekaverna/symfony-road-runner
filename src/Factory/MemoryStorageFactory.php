<?php

declare(strict_types=1);

namespace App\Factory;

use Spiral\RoadRunner\Environment;
use Spiral\RoadRunner\KeyValue\Factory;
use Spiral\Goridge\RPC\RPC;
use Spiral\RoadRunner\KeyValue\StorageInterface;

class MemoryStorageFactory
{
    public function create(string $storageName = 'memory'): StorageInterface
    {
        $env = Environment::fromGlobals();
        $rpc = RPC::create($env->getRPCAddress());
        $factory = new Factory($rpc);

        return $factory->select($storageName);
    }
}

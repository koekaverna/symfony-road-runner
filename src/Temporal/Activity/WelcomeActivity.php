<?php

declare(strict_types=1);

namespace App\Temporal\Activity;

use Temporal\Activity\ActivityInterface;
use Temporal\Activity\ActivityMethod;

#[ActivityInterface]
final class WelcomeActivity
{
    #[ActivityMethod]
    public function sayHello(string $name): string
    {
        return 'Hello, ' . $name;
    }
}

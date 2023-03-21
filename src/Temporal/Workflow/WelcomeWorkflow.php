<?php

declare(strict_types=1);

namespace App\Temporal\Workflow;

use App\Temporal\Activity\WelcomeActivity;
use Temporal\Activity\ActivityOptions;
use Temporal\Workflow;
use Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;

#[WorkflowInterface]
final class WelcomeWorkflow
{
    private $welcomeActivity;

    public function __construct()
    {
        $this->welcomeActivity = Workflow::newActivityStub(
            WelcomeActivity::class,
            ActivityOptions::new()
                ->withStartToCloseTimeout(5)
        );
    }

    #[WorkflowMethod]
    public function run(string $name): \Generator
    {
        return yield $this->welcomeActivity->sayHello($name);
    }
}

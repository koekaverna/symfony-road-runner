<?php

declare(strict_types=1);

namespace App\Controller;

use App\Temporal\Workflow\WelcomeWorkflow;
use Carbon\CarbonInterval;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Temporal\Client\WorkflowClientInterface;
use Temporal\Client\WorkflowOptions;

#[Route('/temporal')]
#[AsController]
final class TemporalController
{
    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly WorkflowClientInterface $workflowClient
    ) {
    }

    public function __invoke(): JsonResponse
    {
        $request = $this->requestStack->getCurrentRequest();
        $name = $request->query->get('name', 'noname');

        $workflow = $this->workflowClient->newWorkflowStub(
            WelcomeWorkflow::class,
            WorkflowOptions::new()->withWorkflowExecutionTimeout(CarbonInterval::minute())
        );

        $result = $workflow->run($name);

        return new JsonResponse([
            'message' => $result,
        ]);
    }
}

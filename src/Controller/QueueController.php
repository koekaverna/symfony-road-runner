<?php

declare(strict_types=1);

namespace App\Controller;

use App\Task\RequestLoggerTask;
use Spiral\RoadRunner\Jobs\JobsInterface;
use Spiral\RoadRunner\Jobs\QueueInterface;
use Spiral\RoadRunner\KeyValue\StorageInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * This controller
 * It's temporally hack. Need to find another way to pass wildcard
 */
#[AsController]
final class QueueController
{
    private ?QueueInterface $queue;

    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly JobsInterface $jobs,
    ) {
        $this->queue = $jobs->connect('request-proxy');
    }

    #[Route('/queue/{a}')]
    #[Route('/queue/{a}/{b}')]
    #[Route('/queue/{a}/{b}/{c}')]
    #[Route('/queue/{a}/{b}/{c}/{d}')]
    #[Route('/queue/{a}/{b}/{c}/{d}/{e}')]
    #[Route('/queue/{a}/{b}/{c}/{d}/{e}/{f}')]
    public function queue(): JsonResponse
    {
        $request = $this->requestStack->getCurrentRequest();

        $task = $this->queue->create(RequestLoggerTask::class, [
            'uri' => $request->getRequestUri(),
            'method' => $request->getMethod(),
            'content' => (string) $request->getContent(),
        ]);

        $this->queue->dispatch($task);

        return new JsonResponse(['isAvailable' => $this->jobs->isAvailable()]);
    }

    #[Route('/queue-list')]
    public function list(StorageInterface $storage): JsonResponse
    {
        $counter = (int) $storage->get('proxy_request_counter');
        $requests = [];
        for($i=0;$i<$counter;$i++) {
            // does not work dont know why
//            $requests[] = $storage->getMultiple([
//                "proxy_request_data_uri_{$i}",
//                "proxy_request_data_method_{$i}",
//                "proxy_request_data_content_{$i}",
//            ]);
            $requests[] = [
                'uri' => $storage->get("proxy_request_data_uri_{$i}"),
                'method' => $storage->get("proxy_request_data_method_{$i}"),
                'content' => $storage->get("proxy_request_data_content_{$i}"),
            ];
        }
        return new JsonResponse([
            'count' => $counter,
            'requests' => $requests,
        ]);
    }
}

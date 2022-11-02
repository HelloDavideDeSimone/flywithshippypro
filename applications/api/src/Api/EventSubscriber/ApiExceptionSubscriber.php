<?php

declare(strict_types=1);

namespace App\Api\EventSubscriber;

use App\Api\Model\ApiProblem;
use const JSON_INVALID_UTF8_IGNORE;
use JsonException;
use RuntimeException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class ApiExceptionSubscriber implements EventSubscriberInterface
{
    private string $environment;

    public function __construct(string $environment = 'dev')
    {
        $this->environment = $environment;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [
            ExceptionEvent::class => 'onKernelException',
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        if (0 !== strpos($event->getRequest()->getPathInfo(), '/api/v')) {
            return;
        }

        $e = $event->getThrowable();

        $statusCode = $e instanceof HttpExceptionInterface ? $e->getStatusCode() : 500;

        $apiProblem = new ApiProblem($statusCode);

        $msg = $apiProblem->toArray();
        if ('prod' !== $this->environment) {
            $msg['exception'] = self::addThrowable($e);
        }

        try {
            $response = new JsonResponse(
                json_encode($msg, \JSON_THROW_ON_ERROR | JSON_INVALID_UTF8_IGNORE),
                $statusCode,
                [],
                true
            );
        } catch (JsonException $e) {
            throw new RuntimeException('', 0, $e);
        }

        $response->headers->set('Content-Type', 'application/problem+json');

        $event->setResponse($response);
    }

    /**
     * @return array<string, mixed>|null
     */
    private static function addThrowable(?Throwable $throwable): ?array
    {
        if (null === $throwable) {
            return null;
        }

        return [
            'message' => $throwable->getMessage(),
            'file' => $throwable->getFile(),
            'line' => $throwable->getLine(),
            'code' => $throwable->getCode(),
            'trace' => $throwable->getTrace(),
            'previous' => self::addThrowable($throwable->getPrevious()),
        ];
    }
}

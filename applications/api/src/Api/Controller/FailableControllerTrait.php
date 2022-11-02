<?php

declare(strict_types=1);

namespace App\Api\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait FailableControllerTrait
{
    protected function fail(string $message, int $httpStatusCode = Response::HTTP_BAD_REQUEST): Response
    {
        return new JsonResponse(['msg' => $message], $httpStatusCode);
    }
}

<?php

declare(strict_types=1);

namespace App\Api\Controller;

use Psr\Log\LoggerInterface;

trait LoggableControllerTrait
{
    protected ?LoggerInterface $logger = null;

    protected function log(string $message, string $level = 'error'): void
    {
        if (null === $this->logger) {
            return;
        }

        $this->logger->log($level, $message);
    }
}

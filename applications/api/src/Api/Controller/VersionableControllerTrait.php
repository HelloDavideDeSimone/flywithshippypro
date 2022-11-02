<?php

namespace App\Api\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

trait VersionableControllerTrait
{
    /**
     * @param int $min
     * @param int $max
     */
    protected function minMaxVersion(int $version, int $min = null, int $max = null): void
    {
        if (null !== $min && $version < $min) {
            throw new HttpException(Response::HTTP_NOT_FOUND);
        }

        if (null !== $max && $version > $max) {
            throw new HttpException(Response::HTTP_NOT_FOUND);
        }
    }
}

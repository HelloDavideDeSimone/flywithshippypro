<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Api\Controller\FailableControllerTrait;
use App\Api\Controller\LoggableControllerTrait;
use App\Api\Controller\VersionableControllerTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiBaseController extends AbstractController
{
    use FailableControllerTrait;
    use LoggableControllerTrait;
    use VersionableControllerTrait;
}

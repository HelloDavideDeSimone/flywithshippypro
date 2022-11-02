<?php

declare(strict_types=1);

namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator as FakerGenerator;

trait FakerTrait
{
    private ?FakerGenerator $fakerGenerator = null;

    public function getFaker(): FakerGenerator
    {
        if (null === $this->fakerGenerator) {
            $this->fakerGenerator = Factory::create('it_IT');
        }

        return $this->fakerGenerator;
    }
}

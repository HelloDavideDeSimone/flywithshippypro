<?php

declare(strict_types=1);

namespace App\DataFixtures;

use Doctrine\DBAL\Connection;
use Symfony\Component\Finder\Finder;

trait LoadDumpsTrait
{
    private function loadDumps(Connection $connection, string $dir): void
    {
        // Bundle to manage file and directories
        $finder = new Finder();
        $finder->in($dir);
        $finder->name('*.sql');
        $finder->files();
        $finder->sortByName();

        foreach ($finder as $file) {
            echo 'Importing: ' . $file->getBasename() . \PHP_EOL;

            $sql = $file->getContents();

            $connection->executeStatement($sql); // Execute native SQL
        }
    }
}

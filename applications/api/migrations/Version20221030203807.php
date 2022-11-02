<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221030203807 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create airport and flight tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE airport (id INT AUTO_INCREMENT NOT NULL, lat DOUBLE PRECISION DEFAULT NULL, lng DOUBLE PRECISION DEFAULT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_7E91F7C277153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flight (id INT AUTO_INCREMENT NOT NULL, price DOUBLE PRECISION DEFAULT NULL, code_departure VARCHAR(255) DEFAULT NULL, code_arrival VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE airport');
        $this->addSql('DROP TABLE flight');
    }
}

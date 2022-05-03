<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220502201039 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE main_sport ADD name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE main_sport ADD duration INT NOT NULL');
        $this->addSql('ALTER TABLE main_sport ADD status VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE main_sport ADD type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE main_sport ALTER tag DROP NOT NULL');
        $this->addSql('ALTER TABLE secondary_sport ADD name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE secondary_sport ADD duration INT NOT NULL');
        $this->addSql('ALTER TABLE secondary_sport ADD status VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE secondary_sport ADD type VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE secondary_sport DROP name');
        $this->addSql('ALTER TABLE secondary_sport DROP duration');
        $this->addSql('ALTER TABLE secondary_sport DROP status');
        $this->addSql('ALTER TABLE secondary_sport DROP type');
        $this->addSql('ALTER TABLE main_sport DROP name');
        $this->addSql('ALTER TABLE main_sport DROP duration');
        $this->addSql('ALTER TABLE main_sport DROP status');
        $this->addSql('ALTER TABLE main_sport DROP type');
        $this->addSql('ALTER TABLE main_sport ALTER tag SET NOT NULL');
    }
}

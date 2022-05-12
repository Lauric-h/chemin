<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220512210315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE main_sport_id_seq CASCADE');
        $this->addSql('DROP TABLE main_sport');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE main_sport_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE main_sport (id INT NOT NULL, sport_session_id INT DEFAULT NULL, distance INT NOT NULL, elevation_gain INT DEFAULT NULL, elevation_loss INT DEFAULT NULL, location VARCHAR(255) DEFAULT NULL, tag VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, duration INT NOT NULL, status VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_b9d95c94521773c2 ON main_sport (sport_session_id)');
        $this->addSql('ALTER TABLE main_sport ADD CONSTRAINT fk_b9d95c94521773c2 FOREIGN KEY (sport_session_id) REFERENCES sport_session (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220502201616 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE sport_session_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE sport_session (id INT NOT NULL, training_plan_id INT DEFAULT NULL, total_duration INT NOT NULL, total_distance INT NOT NULL, total_elevation_gain INT NOT NULL, total_elevation_loss INT DEFAULT NULL, notes TEXT DEFAULT NULL, date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_71F1997E35A79295 ON sport_session (training_plan_id)');
        $this->addSql('ALTER TABLE sport_session ADD CONSTRAINT FK_71F1997E35A79295 FOREIGN KEY (training_plan_id) REFERENCES training_plan (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE main_sport ADD sport_session_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE main_sport ADD CONSTRAINT FK_B9D95C94521773C2 FOREIGN KEY (sport_session_id) REFERENCES sport_session (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_B9D95C94521773C2 ON main_sport (sport_session_id)');
        $this->addSql('ALTER TABLE secondary_sport ADD sport_session_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE secondary_sport ADD CONSTRAINT FK_63F3AB4521773C2 FOREIGN KEY (sport_session_id) REFERENCES sport_session (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_63F3AB4521773C2 ON secondary_sport (sport_session_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE main_sport DROP CONSTRAINT FK_B9D95C94521773C2');
        $this->addSql('ALTER TABLE secondary_sport DROP CONSTRAINT FK_63F3AB4521773C2');
        $this->addSql('DROP SEQUENCE sport_session_id_seq CASCADE');
        $this->addSql('DROP TABLE sport_session');
        $this->addSql('DROP INDEX IDX_B9D95C94521773C2');
        $this->addSql('ALTER TABLE main_sport DROP sport_session_id');
        $this->addSql('DROP INDEX IDX_63F3AB4521773C2');
        $this->addSql('ALTER TABLE secondary_sport DROP sport_session_id');
    }
}

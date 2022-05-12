<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220512204920 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE secondary_sport_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sport_session_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE training_plan_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE secondary_sport (id INT NOT NULL, sport_session_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, duration INT NOT NULL, status VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_63F3AB4521773C2 ON secondary_sport (sport_session_id)');
        $this->addSql('CREATE TABLE sport_session (id INT NOT NULL, training_plan_id INT DEFAULT NULL, total_duration INT DEFAULT NULL, total_distance INT DEFAULT NULL, total_elevation_gain INT DEFAULT NULL, total_elevation_loss INT DEFAULT NULL, notes TEXT DEFAULT NULL, date DATE NOT NULL, main_sports TEXT DEFAULT NULL, secondary_sports TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_71F1997E35A79295 ON sport_session (training_plan_id)');
        $this->addSql('COMMENT ON COLUMN sport_session.main_sports IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN sport_session.secondary_sports IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE training_plan (id INT NOT NULL, name VARCHAR(255) NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, duration INT NOT NULL, is_started BOOLEAN DEFAULT false NOT NULL, status VARCHAR(255) DEFAULT \'Planned\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE secondary_sport ADD CONSTRAINT FK_63F3AB4521773C2 FOREIGN KEY (sport_session_id) REFERENCES sport_session (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sport_session ADD CONSTRAINT FK_71F1997E35A79295 FOREIGN KEY (training_plan_id) REFERENCES training_plan (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE secondary_sport DROP CONSTRAINT FK_63F3AB4521773C2');
        $this->addSql('ALTER TABLE sport_session DROP CONSTRAINT FK_71F1997E35A79295');
        $this->addSql('DROP SEQUENCE secondary_sport_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sport_session_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE training_plan_id_seq CASCADE');
        $this->addSql('DROP TABLE secondary_sport');
        $this->addSql('DROP TABLE sport_session');
        $this->addSql('DROP TABLE training_plan');
        $this->addSql('DROP TABLE messenger_messages');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250121151829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE "checkpoint" (id SERIAL NOT NULL, road_trip_id INT NOT NULL, spot_name VARCHAR(255) NOT NULL, longitude DOUBLE PRECISION NOT NULL, latitude DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F00F7BEFBF41406 ON "checkpoint" (road_trip_id)');
        $this->addSql('CREATE TABLE "road_trip" (id SERIAL NOT NULL, vehicle_id INT NOT NULL, user_id INT NOT NULL, title VARCHAR(255) NOT NULL, cover_image VARCHAR(255) NOT NULL, start_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, end_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, is_community BOOLEAN DEFAULT false NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_626235CA545317D1 ON "road_trip" (vehicle_id)');
        $this->addSql('CREATE INDEX IDX_626235CAA76ED395 ON "road_trip" (user_id)');
        $this->addSql('CREATE TABLE "user" (id SERIAL NOT NULL, email VARCHAR(180) NOT NULL, username VARCHAR(255) DEFAULT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON "user" (email)');
        $this->addSql('CREATE TABLE "vehicle" (id SERIAL NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE "checkpoint" ADD CONSTRAINT FK_F00F7BEFBF41406 FOREIGN KEY (road_trip_id) REFERENCES "road_trip" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "road_trip" ADD CONSTRAINT FK_626235CA545317D1 FOREIGN KEY (vehicle_id) REFERENCES "vehicle" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "road_trip" ADD CONSTRAINT FK_626235CAA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "checkpoint" DROP CONSTRAINT FK_F00F7BEFBF41406');
        $this->addSql('ALTER TABLE "road_trip" DROP CONSTRAINT FK_626235CA545317D1');
        $this->addSql('ALTER TABLE "road_trip" DROP CONSTRAINT FK_626235CAA76ED395');
        $this->addSql('DROP TABLE "checkpoint"');
        $this->addSql('DROP TABLE "road_trip"');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE "vehicle"');
        $this->addSql('DROP TABLE messenger_messages');
    }
}

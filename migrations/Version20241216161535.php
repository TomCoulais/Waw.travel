<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241216161535 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE "checkpoint" (id VARCHAR(255) NOT NULL, road_trip_id VARCHAR(255) NOT NULL, spot_name VARCHAR(255) NOT NULL, google_maps_coords VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F00F7BEFBF41406 ON "checkpoint" (road_trip_id)');
        $this->addSql('CREATE TABLE "road_trip" (id VARCHAR(255) NOT NULL, vehicle_id VARCHAR(255) NOT NULL, user_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_626235CA545317D1 ON "road_trip" (vehicle_id)');
        $this->addSql('CREATE INDEX IDX_626235CAA76ED395 ON "road_trip" (user_id)');
        $this->addSql('CREATE TABLE "vehicles" (id VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE "checkpoint" ADD CONSTRAINT FK_F00F7BEFBF41406 FOREIGN KEY (road_trip_id) REFERENCES "road_trip" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "road_trip" ADD CONSTRAINT FK_626235CA545317D1 FOREIGN KEY (vehicle_id) REFERENCES "vehicles" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
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
        $this->addSql('DROP TABLE "vehicles"');
    }
}

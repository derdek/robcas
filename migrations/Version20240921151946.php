<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240921151946 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE player (id INT NOT NULL, name VARCHAR(127) NOT NULL, "user" VARCHAR(255) NOT NULL, race VARCHAR(31) NOT NULL, class VARCHAR(31) DEFAULT NULL, game VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE game ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD player_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game DROP "user"');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_232B318CA76ED395 ON game (user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_232B318C99E6F5DF ON game (player_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318C99E6F5DF');
        $this->addSql('DROP TABLE player');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318CA76ED395');
        $this->addSql('DROP INDEX IDX_232B318CA76ED395');
        $this->addSql('DROP INDEX UNIQ_232B318C99E6F5DF');
        $this->addSql('ALTER TABLE game ADD "user" VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE game DROP user_id');
        $this->addSql('ALTER TABLE game DROP player_id');
    }
}

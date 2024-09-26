<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240921155013 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP CONSTRAINT fk_232b318c99e6f5df');
        $this->addSql('DROP INDEX uniq_232b318c99e6f5df');
        $this->addSql('ALTER TABLE game DROP player_id');
        $this->addSql('ALTER TABLE player ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE player ADD game_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE player DROP "user"');
        $this->addSql('ALTER TABLE player DROP game');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_98197A65A76ED395 ON player (user_id)');
        $this->addSql('CREATE INDEX IDX_98197A65E48FD905 ON player (game_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE player DROP CONSTRAINT FK_98197A65A76ED395');
        $this->addSql('ALTER TABLE player DROP CONSTRAINT FK_98197A65E48FD905');
        $this->addSql('DROP INDEX IDX_98197A65A76ED395');
        $this->addSql('DROP INDEX IDX_98197A65E48FD905');
        $this->addSql('ALTER TABLE player ADD "user" VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE player ADD game VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE player DROP user_id');
        $this->addSql('ALTER TABLE player DROP game_id');
        $this->addSql('ALTER TABLE game ADD player_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT fk_232b318c99e6f5df FOREIGN KEY (player_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_232b318c99e6f5df ON game (player_id)');
    }
}

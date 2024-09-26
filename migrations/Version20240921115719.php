<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240921115719 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE card ADD card_type VARCHAR(31) NOT NULL');
        $this->addSql('ALTER TABLE card ADD card_action VARCHAR(31) NOT NULL');
        $this->addSql('ALTER TABLE card ADD description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE card ADD level INT NOT NULL');
        $this->addSql('ALTER TABLE card ADD level_reward INT NOT NULL');
        $this->addSql('ALTER TABLE card ADD treasure_reward INT NOT NULL');
        $this->addSql('ALTER TABLE card ADD lose_description VARCHAR(255) NOT NULL');
        $this->addSql('CREATE INDEX card_type_index ON card (card_type)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX card_type_index');
        $this->addSql('ALTER TABLE card DROP card_type');
        $this->addSql('ALTER TABLE card DROP card_action');
        $this->addSql('ALTER TABLE card DROP description');
        $this->addSql('ALTER TABLE card DROP level');
        $this->addSql('ALTER TABLE card DROP level_reward');
        $this->addSql('ALTER TABLE card DROP treasure_reward');
        $this->addSql('ALTER TABLE card DROP lose_description');
    }
}

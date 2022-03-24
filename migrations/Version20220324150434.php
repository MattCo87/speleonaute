<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220324150434 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__action_strategie AS SELECT id, position_action FROM action_strategie');
        $this->addSql('DROP TABLE action_strategie');
        $this->addSql('CREATE TABLE action_strategie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lien_action_id INTEGER DEFAULT NULL, lien_strategie_id INTEGER DEFAULT NULL, position_action INTEGER NOT NULL, CONSTRAINT FK_DFB1A3967F82280D FOREIGN KEY (lien_action_id) REFERENCES "action" (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_DFB1A3969219F1EC FOREIGN KEY (lien_strategie_id) REFERENCES strategie (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO action_strategie (id, position_action) SELECT id, position_action FROM __temp__action_strategie');
        $this->addSql('DROP TABLE __temp__action_strategie');
        $this->addSql('CREATE INDEX IDX_DFB1A3967F82280D ON action_strategie (lien_action_id)');
        $this->addSql('CREATE INDEX IDX_DFB1A3969219F1EC ON action_strategie (lien_strategie_id)');
        $this->addSql('DROP INDEX IDX_7CE748AA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__reset_password_request AS SELECT id, user_id, selector, hashed_token, requested_at, expires_at FROM reset_password_request');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('CREATE TABLE reset_password_request (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , expires_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO reset_password_request (id, user_id, selector, hashed_token, requested_at, expires_at) SELECT id, user_id, selector, hashed_token, requested_at, expires_at FROM __temp__reset_password_request');
        $this->addSql('DROP TABLE __temp__reset_password_request');
        $this->addSql('CREATE INDEX IDX_7CE748AA76ED395 ON reset_password_request (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_DFB1A3967F82280D');
        $this->addSql('DROP INDEX IDX_DFB1A3969219F1EC');
        $this->addSql('CREATE TEMPORARY TABLE __temp__action_strategie AS SELECT id, position_action FROM action_strategie');
        $this->addSql('DROP TABLE action_strategie');
        $this->addSql('CREATE TABLE action_strategie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, position_action INTEGER NOT NULL)');
        $this->addSql('INSERT INTO action_strategie (id, position_action) SELECT id, position_action FROM __temp__action_strategie');
        $this->addSql('DROP TABLE __temp__action_strategie');
        $this->addSql('DROP INDEX IDX_7CE748AA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__reset_password_request AS SELECT id, user_id, selector, hashed_token, requested_at, expires_at FROM reset_password_request');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('CREATE TABLE reset_password_request (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , expires_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO reset_password_request (id, user_id, selector, hashed_token, requested_at, expires_at) SELECT id, user_id, selector, hashed_token, requested_at, expires_at FROM __temp__reset_password_request');
        $this->addSql('DROP TABLE __temp__reset_password_request');
        $this->addSql('CREATE INDEX IDX_7CE748AA76ED395 ON reset_password_request (user_id)');
    }
}

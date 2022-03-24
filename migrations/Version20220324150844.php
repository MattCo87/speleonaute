<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220324150844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_DFB1A3969219F1EC');
        $this->addSql('DROP INDEX IDX_DFB1A3967F82280D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__action_strategie AS SELECT id, lien_action_id, lien_strategie_id, position_action FROM action_strategie');
        $this->addSql('DROP TABLE action_strategie');
        $this->addSql('CREATE TABLE action_strategie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lien_action_id INTEGER DEFAULT NULL, lien_strategie_id INTEGER DEFAULT NULL, position_action INTEGER NOT NULL, CONSTRAINT FK_DFB1A3967F82280D FOREIGN KEY (lien_action_id) REFERENCES "action" (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_DFB1A3969219F1EC FOREIGN KEY (lien_strategie_id) REFERENCES strategie (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO action_strategie (id, lien_action_id, lien_strategie_id, position_action) SELECT id, lien_action_id, lien_strategie_id, position_action FROM __temp__action_strategie');
        $this->addSql('DROP TABLE __temp__action_strategie');
        $this->addSql('CREATE INDEX IDX_DFB1A3969219F1EC ON action_strategie (lien_strategie_id)');
        $this->addSql('CREATE INDEX IDX_DFB1A3967F82280D ON action_strategie (lien_action_id)');
        $this->addSql('DROP INDEX IDX_7CE748AA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__reset_password_request AS SELECT id, user_id, selector, hashed_token, requested_at, expires_at FROM reset_password_request');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('CREATE TABLE reset_password_request (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , expires_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO reset_password_request (id, user_id, selector, hashed_token, requested_at, expires_at) SELECT id, user_id, selector, hashed_token, requested_at, expires_at FROM __temp__reset_password_request');
        $this->addSql('DROP TABLE __temp__reset_password_request');
        $this->addSql('CREATE INDEX IDX_7CE748AA76ED395 ON reset_password_request (user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__statistique_creature AS SELECT id, valeur FROM statistique_creature');
        $this->addSql('DROP TABLE statistique_creature');
        $this->addSql('CREATE TABLE statistique_creature (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lien_creature_id INTEGER DEFAULT NULL, lien_statistique_id INTEGER DEFAULT NULL, valeur INTEGER NOT NULL, CONSTRAINT FK_8D72AEE6900DB4E5 FOREIGN KEY (lien_creature_id) REFERENCES creature (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8D72AEE6AD0F192C FOREIGN KEY (lien_statistique_id) REFERENCES statistique (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO statistique_creature (id, valeur) SELECT id, valeur FROM __temp__statistique_creature');
        $this->addSql('DROP TABLE __temp__statistique_creature');
        $this->addSql('CREATE INDEX IDX_8D72AEE6900DB4E5 ON statistique_creature (lien_creature_id)');
        $this->addSql('CREATE INDEX IDX_8D72AEE6AD0F192C ON statistique_creature (lien_statistique_id)');
        $this->addSql('DROP INDEX IDX_2EC9C551AD0F192C');
        $this->addSql('DROP INDEX IDX_2EC9C5514EA46F32');
        $this->addSql('CREATE TEMPORARY TABLE __temp__statistique_modele AS SELECT id, lien_modele_id, lien_statistique_id, valeur_min, valeur_max, valeur_niv FROM statistique_modele');
        $this->addSql('DROP TABLE statistique_modele');
        $this->addSql('CREATE TABLE statistique_modele (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lien_modele_id INTEGER DEFAULT NULL, lien_statistique_id INTEGER DEFAULT NULL, valeur_min INTEGER NOT NULL, valeur_max INTEGER NOT NULL, valeur_niv INTEGER NOT NULL, CONSTRAINT FK_2EC9C5514EA46F32 FOREIGN KEY (lien_modele_id) REFERENCES modele (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2EC9C551AD0F192C FOREIGN KEY (lien_statistique_id) REFERENCES statistique (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO statistique_modele (id, lien_modele_id, lien_statistique_id, valeur_min, valeur_max, valeur_niv) SELECT id, lien_modele_id, lien_statistique_id, valeur_min, valeur_max, valeur_niv FROM __temp__statistique_modele');
        $this->addSql('DROP TABLE __temp__statistique_modele');
        $this->addSql('CREATE INDEX IDX_2EC9C551AD0F192C ON statistique_modele (lien_statistique_id)');
        $this->addSql('CREATE INDEX IDX_2EC9C5514EA46F32 ON statistique_modele (lien_modele_id)');
        $this->addSql('DROP INDEX IDX_67333C3F9219F1EC');
        $this->addSql('DROP INDEX IDX_67333C3F4EA46F32');
        $this->addSql('CREATE TEMPORARY TABLE __temp__strategie_modele AS SELECT id, lien_strategie_id, lien_modele_id, position_strategie FROM strategie_modele');
        $this->addSql('DROP TABLE strategie_modele');
        $this->addSql('CREATE TABLE strategie_modele (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lien_strategie_id INTEGER DEFAULT NULL, lien_modele_id INTEGER DEFAULT NULL, position_strategie INTEGER NOT NULL, CONSTRAINT FK_67333C3F9219F1EC FOREIGN KEY (lien_strategie_id) REFERENCES strategie (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_67333C3F4EA46F32 FOREIGN KEY (lien_modele_id) REFERENCES modele (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO strategie_modele (id, lien_strategie_id, lien_modele_id, position_strategie) SELECT id, lien_strategie_id, lien_modele_id, position_strategie FROM __temp__strategie_modele');
        $this->addSql('DROP TABLE __temp__strategie_modele');
        $this->addSql('CREATE INDEX IDX_67333C3F9219F1EC ON strategie_modele (lien_strategie_id)');
        $this->addSql('CREATE INDEX IDX_67333C3F4EA46F32 ON strategie_modele (lien_modele_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_DFB1A3967F82280D');
        $this->addSql('DROP INDEX IDX_DFB1A3969219F1EC');
        $this->addSql('CREATE TEMPORARY TABLE __temp__action_strategie AS SELECT id, lien_action_id, lien_strategie_id, position_action FROM action_strategie');
        $this->addSql('DROP TABLE action_strategie');
        $this->addSql('CREATE TABLE action_strategie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lien_action_id INTEGER DEFAULT NULL, lien_strategie_id INTEGER DEFAULT NULL, position_action INTEGER NOT NULL)');
        $this->addSql('INSERT INTO action_strategie (id, lien_action_id, lien_strategie_id, position_action) SELECT id, lien_action_id, lien_strategie_id, position_action FROM __temp__action_strategie');
        $this->addSql('DROP TABLE __temp__action_strategie');
        $this->addSql('CREATE INDEX IDX_DFB1A3967F82280D ON action_strategie (lien_action_id)');
        $this->addSql('CREATE INDEX IDX_DFB1A3969219F1EC ON action_strategie (lien_strategie_id)');
        $this->addSql('DROP INDEX IDX_7CE748AA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__reset_password_request AS SELECT id, user_id, selector, hashed_token, requested_at, expires_at FROM reset_password_request');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('CREATE TABLE reset_password_request (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , expires_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO reset_password_request (id, user_id, selector, hashed_token, requested_at, expires_at) SELECT id, user_id, selector, hashed_token, requested_at, expires_at FROM __temp__reset_password_request');
        $this->addSql('DROP TABLE __temp__reset_password_request');
        $this->addSql('CREATE INDEX IDX_7CE748AA76ED395 ON reset_password_request (user_id)');
        $this->addSql('DROP INDEX IDX_8D72AEE6900DB4E5');
        $this->addSql('DROP INDEX IDX_8D72AEE6AD0F192C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__statistique_creature AS SELECT id, valeur FROM statistique_creature');
        $this->addSql('DROP TABLE statistique_creature');
        $this->addSql('CREATE TABLE statistique_creature (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, valeur INTEGER NOT NULL)');
        $this->addSql('INSERT INTO statistique_creature (id, valeur) SELECT id, valeur FROM __temp__statistique_creature');
        $this->addSql('DROP TABLE __temp__statistique_creature');
        $this->addSql('DROP INDEX IDX_2EC9C5514EA46F32');
        $this->addSql('DROP INDEX IDX_2EC9C551AD0F192C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__statistique_modele AS SELECT id, lien_modele_id, lien_statistique_id, valeur_min, valeur_max, valeur_niv FROM statistique_modele');
        $this->addSql('DROP TABLE statistique_modele');
        $this->addSql('CREATE TABLE statistique_modele (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lien_modele_id INTEGER DEFAULT NULL, lien_statistique_id INTEGER DEFAULT NULL, valeur_min INTEGER NOT NULL, valeur_max INTEGER NOT NULL, valeur_niv INTEGER NOT NULL)');
        $this->addSql('INSERT INTO statistique_modele (id, lien_modele_id, lien_statistique_id, valeur_min, valeur_max, valeur_niv) SELECT id, lien_modele_id, lien_statistique_id, valeur_min, valeur_max, valeur_niv FROM __temp__statistique_modele');
        $this->addSql('DROP TABLE __temp__statistique_modele');
        $this->addSql('CREATE INDEX IDX_2EC9C5514EA46F32 ON statistique_modele (lien_modele_id)');
        $this->addSql('CREATE INDEX IDX_2EC9C551AD0F192C ON statistique_modele (lien_statistique_id)');
        $this->addSql('DROP INDEX IDX_67333C3F9219F1EC');
        $this->addSql('DROP INDEX IDX_67333C3F4EA46F32');
        $this->addSql('CREATE TEMPORARY TABLE __temp__strategie_modele AS SELECT id, lien_strategie_id, lien_modele_id, position_strategie FROM strategie_modele');
        $this->addSql('DROP TABLE strategie_modele');
        $this->addSql('CREATE TABLE strategie_modele (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lien_strategie_id INTEGER DEFAULT NULL, lien_modele_id INTEGER DEFAULT NULL, position_strategie INTEGER NOT NULL)');
        $this->addSql('INSERT INTO strategie_modele (id, lien_strategie_id, lien_modele_id, position_strategie) SELECT id, lien_strategie_id, lien_modele_id, position_strategie FROM __temp__strategie_modele');
        $this->addSql('DROP TABLE __temp__strategie_modele');
        $this->addSql('CREATE INDEX IDX_67333C3F9219F1EC ON strategie_modele (lien_strategie_id)');
        $this->addSql('CREATE INDEX IDX_67333C3F4EA46F32 ON strategie_modele (lien_modele_id)');
    }
}

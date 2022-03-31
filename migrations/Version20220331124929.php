<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220331124929 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE "action" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, toucher INTEGER NOT NULL, degat INTEGER NOT NULL, tier INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE action_strategie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lien_action_id INTEGER DEFAULT NULL, lien_strategie_id INTEGER DEFAULT NULL, position_action INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_DFB1A3967F82280D ON action_strategie (lien_action_id)');
        $this->addSql('CREATE INDEX IDX_DFB1A3969219F1EC ON action_strategie (lien_strategie_id)');
        $this->addSql('CREATE TABLE combat (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lien_user_id INTEGER DEFAULT NULL, lien_scenario_id INTEGER DEFAULT NULL, date_combat DATE NOT NULL, fichier_log VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_8D51E398687F37D8 ON combat (lien_user_id)');
        $this->addSql('CREATE INDEX IDX_8D51E3987FD94D72 ON combat (lien_scenario_id)');
        $this->addSql('CREATE TABLE creature (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lien_modele_id INTEGER DEFAULT NULL, lien_user_id INTEGER DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, niveau INTEGER DEFAULT NULL, exp INTEGER DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_2A6C6AF44EA46F32 ON creature (lien_modele_id)');
        $this->addSql('CREATE INDEX IDX_2A6C6AF4687F37D8 ON creature (lien_user_id)');
        $this->addSql('CREATE TABLE creature_formation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lien_creature_id INTEGER DEFAULT NULL, lien_formation_id INTEGER DEFAULT NULL, localisation INTEGER DEFAULT NULL, strategie INTEGER DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_31BF745D900DB4E5 ON creature_formation (lien_creature_id)');
        $this->addSql('CREATE INDEX IDX_31BF745DFAF8607F ON creature_formation (lien_formation_id)');
        $this->addSql('CREATE TABLE formation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lien_user_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_404021BF687F37D8 ON formation (lien_user_id)');
        $this->addSql('CREATE TABLE modele (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom_modele VARCHAR(255) NOT NULL, rarete INTEGER NOT NULL, point_niv INTEGER NOT NULL, ouvrable BOOLEAN NOT NULL)');
        $this->addSql('CREATE TABLE reset_password_request (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , expires_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_7CE748AA76ED395 ON reset_password_request (user_id)');
        $this->addSql('CREATE TABLE scenario (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lien_formation_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL, description CLOB NOT NULL, recompense INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_3E45C8D8FAF8607F ON scenario (lien_formation_id)');
        $this->addSql('CREATE TABLE statistique (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE statistique_creature (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lien_creature_id INTEGER DEFAULT NULL, lien_statistique_id INTEGER DEFAULT NULL, valeur INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_8D72AEE6900DB4E5 ON statistique_creature (lien_creature_id)');
        $this->addSql('CREATE INDEX IDX_8D72AEE6AD0F192C ON statistique_creature (lien_statistique_id)');
        $this->addSql('CREATE TABLE statistique_modele (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lien_modele_id INTEGER DEFAULT NULL, lien_statistique_id INTEGER DEFAULT NULL, valeur_min INTEGER NOT NULL, valeur_max INTEGER NOT NULL, valeur_niv INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_2EC9C5514EA46F32 ON statistique_modele (lien_modele_id)');
        $this->addSql('CREATE INDEX IDX_2EC9C551AD0F192C ON statistique_modele (lien_statistique_id)');
        $this->addSql('CREATE TABLE strategie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE strategie_modele (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lien_strategie_id INTEGER DEFAULT NULL, lien_modele_id INTEGER DEFAULT NULL, position_strategie INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_67333C3F9219F1EC ON strategie_modele (lien_strategie_id)');
        $this->addSql('CREATE INDEX IDX_67333C3F4EA46F32 ON strategie_modele (lien_modele_id)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, reputation INTEGER DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE "action"');
        $this->addSql('DROP TABLE action_strategie');
        $this->addSql('DROP TABLE combat');
        $this->addSql('DROP TABLE creature');
        $this->addSql('DROP TABLE creature_formation');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE modele');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE scenario');
        $this->addSql('DROP TABLE statistique');
        $this->addSql('DROP TABLE statistique_creature');
        $this->addSql('DROP TABLE statistique_modele');
        $this->addSql('DROP TABLE strategie');
        $this->addSql('DROP TABLE strategie_modele');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}

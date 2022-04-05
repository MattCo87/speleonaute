<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220331125405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `action` (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, toucher INT NOT NULL, degat INT NOT NULL, tier INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE action_strategie (id INT AUTO_INCREMENT NOT NULL, lien_action_id INT DEFAULT NULL, lien_strategie_id INT DEFAULT NULL, position_action INT NOT NULL, INDEX IDX_DFB1A3967F82280D (lien_action_id), INDEX IDX_DFB1A3969219F1EC (lien_strategie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE combat (id INT AUTO_INCREMENT NOT NULL, lien_user_id INT DEFAULT NULL, lien_scenario_id INT DEFAULT NULL, date_combat DATE NOT NULL, fichier_log VARCHAR(255) NOT NULL, INDEX IDX_8D51E398687F37D8 (lien_user_id), INDEX IDX_8D51E3987FD94D72 (lien_scenario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE creature (id INT AUTO_INCREMENT NOT NULL, lien_modele_id INT DEFAULT NULL, lien_user_id INT DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, niveau INT DEFAULT NULL, exp INT DEFAULT NULL, INDEX IDX_2A6C6AF44EA46F32 (lien_modele_id), INDEX IDX_2A6C6AF4687F37D8 (lien_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE creature_formation (id INT AUTO_INCREMENT NOT NULL, lien_creature_id INT DEFAULT NULL, lien_formation_id INT DEFAULT NULL, localisation INT DEFAULT NULL, strategie INT DEFAULT NULL, INDEX IDX_31BF745D900DB4E5 (lien_creature_id), INDEX IDX_31BF745DFAF8607F (lien_formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, lien_user_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_404021BF687F37D8 (lien_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modele (id INT AUTO_INCREMENT NOT NULL, nom_modele VARCHAR(255) NOT NULL, rarete INT NOT NULL, point_niv INT NOT NULL, ouvrable TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE scenario (id INT AUTO_INCREMENT NOT NULL, lien_formation_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, recompense INT NOT NULL, INDEX IDX_3E45C8D8FAF8607F (lien_formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statistique (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statistique_creature (id INT AUTO_INCREMENT NOT NULL, lien_creature_id INT DEFAULT NULL, lien_statistique_id INT DEFAULT NULL, valeur INT NOT NULL, INDEX IDX_8D72AEE6900DB4E5 (lien_creature_id), INDEX IDX_8D72AEE6AD0F192C (lien_statistique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statistique_modele (id INT AUTO_INCREMENT NOT NULL, lien_modele_id INT DEFAULT NULL, lien_statistique_id INT DEFAULT NULL, valeur_min INT NOT NULL, valeur_max INT NOT NULL, valeur_niv INT NOT NULL, INDEX IDX_2EC9C5514EA46F32 (lien_modele_id), INDEX IDX_2EC9C551AD0F192C (lien_statistique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE strategie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE strategie_modele (id INT AUTO_INCREMENT NOT NULL, lien_strategie_id INT DEFAULT NULL, lien_modele_id INT DEFAULT NULL, position_strategie INT NOT NULL, INDEX IDX_67333C3F9219F1EC (lien_strategie_id), INDEX IDX_67333C3F4EA46F32 (lien_modele_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, reputation INT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE action_strategie ADD CONSTRAINT FK_DFB1A3967F82280D FOREIGN KEY (lien_action_id) REFERENCES `action` (id)');
        $this->addSql('ALTER TABLE action_strategie ADD CONSTRAINT FK_DFB1A3969219F1EC FOREIGN KEY (lien_strategie_id) REFERENCES strategie (id)');
        $this->addSql('ALTER TABLE combat ADD CONSTRAINT FK_8D51E398687F37D8 FOREIGN KEY (lien_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE combat ADD CONSTRAINT FK_8D51E3987FD94D72 FOREIGN KEY (lien_scenario_id) REFERENCES scenario (id)');
        $this->addSql('ALTER TABLE creature ADD CONSTRAINT FK_2A6C6AF44EA46F32 FOREIGN KEY (lien_modele_id) REFERENCES modele (id)');
        $this->addSql('ALTER TABLE creature ADD CONSTRAINT FK_2A6C6AF4687F37D8 FOREIGN KEY (lien_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE creature_formation ADD CONSTRAINT FK_31BF745D900DB4E5 FOREIGN KEY (lien_creature_id) REFERENCES creature (id)');
        $this->addSql('ALTER TABLE creature_formation ADD CONSTRAINT FK_31BF745DFAF8607F FOREIGN KEY (lien_formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF687F37D8 FOREIGN KEY (lien_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE scenario ADD CONSTRAINT FK_3E45C8D8FAF8607F FOREIGN KEY (lien_formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE statistique_creature ADD CONSTRAINT FK_8D72AEE6900DB4E5 FOREIGN KEY (lien_creature_id) REFERENCES creature (id)');
        $this->addSql('ALTER TABLE statistique_creature ADD CONSTRAINT FK_8D72AEE6AD0F192C FOREIGN KEY (lien_statistique_id) REFERENCES statistique (id)');
        $this->addSql('ALTER TABLE statistique_modele ADD CONSTRAINT FK_2EC9C5514EA46F32 FOREIGN KEY (lien_modele_id) REFERENCES modele (id)');
        $this->addSql('ALTER TABLE statistique_modele ADD CONSTRAINT FK_2EC9C551AD0F192C FOREIGN KEY (lien_statistique_id) REFERENCES statistique (id)');
        $this->addSql('ALTER TABLE strategie_modele ADD CONSTRAINT FK_67333C3F9219F1EC FOREIGN KEY (lien_strategie_id) REFERENCES strategie (id)');
        $this->addSql('ALTER TABLE strategie_modele ADD CONSTRAINT FK_67333C3F4EA46F32 FOREIGN KEY (lien_modele_id) REFERENCES modele (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE action_strategie DROP FOREIGN KEY FK_DFB1A3967F82280D');
        $this->addSql('ALTER TABLE creature_formation DROP FOREIGN KEY FK_31BF745D900DB4E5');
        $this->addSql('ALTER TABLE statistique_creature DROP FOREIGN KEY FK_8D72AEE6900DB4E5');
        $this->addSql('ALTER TABLE creature_formation DROP FOREIGN KEY FK_31BF745DFAF8607F');
        $this->addSql('ALTER TABLE scenario DROP FOREIGN KEY FK_3E45C8D8FAF8607F');
        $this->addSql('ALTER TABLE creature DROP FOREIGN KEY FK_2A6C6AF44EA46F32');
        $this->addSql('ALTER TABLE statistique_modele DROP FOREIGN KEY FK_2EC9C5514EA46F32');
        $this->addSql('ALTER TABLE strategie_modele DROP FOREIGN KEY FK_67333C3F4EA46F32');
        $this->addSql('ALTER TABLE combat DROP FOREIGN KEY FK_8D51E3987FD94D72');
        $this->addSql('ALTER TABLE statistique_creature DROP FOREIGN KEY FK_8D72AEE6AD0F192C');
        $this->addSql('ALTER TABLE statistique_modele DROP FOREIGN KEY FK_2EC9C551AD0F192C');
        $this->addSql('ALTER TABLE action_strategie DROP FOREIGN KEY FK_DFB1A3969219F1EC');
        $this->addSql('ALTER TABLE strategie_modele DROP FOREIGN KEY FK_67333C3F9219F1EC');
        $this->addSql('ALTER TABLE combat DROP FOREIGN KEY FK_8D51E398687F37D8');
        $this->addSql('ALTER TABLE creature DROP FOREIGN KEY FK_2A6C6AF4687F37D8');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF687F37D8');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE `action`');
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

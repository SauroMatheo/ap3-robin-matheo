<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230919141541 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_commande (id INT AUTO_INCREMENT NOT NULL, fk_articles_id INT NOT NULL, fk_commande_id INT NOT NULL, quantite SMALLINT NOT NULL, INDEX IDX_3B025216774C5AF8 (fk_articles_id), INDEX IDX_3B025216EB1C8260 (fk_commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, fk_rayons_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, prix NUMERIC(10, 2) NOT NULL, INDEX IDX_BFDD316839E7A43 (fk_rayons_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commandes (id INT AUTO_INCREMENT NOT NULL, fk_utilisateurs_id INT DEFAULT NULL, fk_etat_id INT NOT NULL, date_commande DATETIME NOT NULL, date_reception DATETIME NOT NULL, INDEX IDX_35D4282CD84A3DF0 (fk_utilisateurs_id), INDEX IDX_35D4282CFD71BBD3 (fk_etat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etats (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE magasins (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, adresse VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rayons (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stockage (id INT AUTO_INCREMENT NOT NULL, fk_articles_id INT NOT NULL, fk_magasins_id INT NOT NULL, quantite SMALLINT NOT NULL, INDEX IDX_CABCB492774C5AF8 (fk_articles_id), INDEX IDX_CABCB492B7A4ABB9 (fk_magasins_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateurs (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(100) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, adresse VARCHAR(255) NOT NULL, date_de_naissance DATE NOT NULL, date_inscription DATE NOT NULL, tel VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_commande ADD CONSTRAINT FK_3B025216774C5AF8 FOREIGN KEY (fk_articles_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE article_commande ADD CONSTRAINT FK_3B025216EB1C8260 FOREIGN KEY (fk_commande_id) REFERENCES commandes (id)');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD316839E7A43 FOREIGN KEY (fk_rayons_id) REFERENCES rayons (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282CD84A3DF0 FOREIGN KEY (fk_utilisateurs_id) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282CFD71BBD3 FOREIGN KEY (fk_etat_id) REFERENCES etats (id)');
        $this->addSql('ALTER TABLE stockage ADD CONSTRAINT FK_CABCB492774C5AF8 FOREIGN KEY (fk_articles_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE stockage ADD CONSTRAINT FK_CABCB492B7A4ABB9 FOREIGN KEY (fk_magasins_id) REFERENCES magasins (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_commande DROP FOREIGN KEY FK_3B025216774C5AF8');
        $this->addSql('ALTER TABLE article_commande DROP FOREIGN KEY FK_3B025216EB1C8260');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD316839E7A43');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282CD84A3DF0');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282CFD71BBD3');
        $this->addSql('ALTER TABLE stockage DROP FOREIGN KEY FK_CABCB492774C5AF8');
        $this->addSql('ALTER TABLE stockage DROP FOREIGN KEY FK_CABCB492B7A4ABB9');
        $this->addSql('DROP TABLE article_commande');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP TABLE etats');
        $this->addSql('DROP TABLE magasins');
        $this->addSql('DROP TABLE rayons');
        $this->addSql('DROP TABLE stockage');
        $this->addSql('DROP TABLE utilisateurs');
        $this->addSql('DROP TABLE messenger_messages');
    }
}

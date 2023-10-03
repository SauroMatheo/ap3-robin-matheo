<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231003124421 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_article (id INT AUTO_INCREMENT NOT NULL, l_article_id INT NOT NULL, lien_image VARCHAR(255) NOT NULL, INDEX IDX_972A59BA2CD520EE (l_article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image_article ADD CONSTRAINT FK_972A59BA2CD520EE FOREIGN KEY (l_article_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE articles ADD le_fournisseur_id INT NOT NULL, CHANGE prix prixuniht NUMERIC(10, 2) NOT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168ACB564 FOREIGN KEY (le_fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('CREATE INDEX IDX_BFDD3168ACB564 ON articles (le_fournisseur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168ACB564');
        $this->addSql('ALTER TABLE image_article DROP FOREIGN KEY FK_972A59BA2CD520EE');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE image_article');
        $this->addSql('DROP INDEX IDX_BFDD3168ACB564 ON articles');
        $this->addSql('ALTER TABLE articles DROP le_fournisseur_id, CHANGE prixuniht prix NUMERIC(10, 2) NOT NULL');
    }
}

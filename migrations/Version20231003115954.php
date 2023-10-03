<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231003115954 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE enfants (id INT AUTO_INCREMENT NOT NULL, age INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sport (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sport_utilisateurs (sport_id INT NOT NULL, utilisateurs_id INT NOT NULL, INDEX IDX_D6A7E0BFAC78BCF8 (sport_id), INDEX IDX_D6A7E0BF1E969C5 (utilisateurs_id), PRIMARY KEY(sport_id, utilisateurs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sport_articles (sport_id INT NOT NULL, articles_id INT NOT NULL, INDEX IDX_897FCED2AC78BCF8 (sport_id), INDEX IDX_897FCED21EBAF6CC (articles_id), PRIMARY KEY(sport_id, articles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sport_utilisateurs ADD CONSTRAINT FK_D6A7E0BFAC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sport_utilisateurs ADD CONSTRAINT FK_D6A7E0BF1E969C5 FOREIGN KEY (utilisateurs_id) REFERENCES utilisateurs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sport_articles ADD CONSTRAINT FK_897FCED2AC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sport_articles ADD CONSTRAINT FK_897FCED21EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateurs ADD enfants_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateurs ADD CONSTRAINT FK_497B315EA586286C FOREIGN KEY (enfants_id) REFERENCES enfants (id)');
        $this->addSql('CREATE INDEX IDX_497B315EA586286C ON utilisateurs (enfants_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateurs DROP FOREIGN KEY FK_497B315EA586286C');
        $this->addSql('ALTER TABLE sport_utilisateurs DROP FOREIGN KEY FK_D6A7E0BFAC78BCF8');
        $this->addSql('ALTER TABLE sport_utilisateurs DROP FOREIGN KEY FK_D6A7E0BF1E969C5');
        $this->addSql('ALTER TABLE sport_articles DROP FOREIGN KEY FK_897FCED2AC78BCF8');
        $this->addSql('ALTER TABLE sport_articles DROP FOREIGN KEY FK_897FCED21EBAF6CC');
        $this->addSql('DROP TABLE enfants');
        $this->addSql('DROP TABLE sport');
        $this->addSql('DROP TABLE sport_utilisateurs');
        $this->addSql('DROP TABLE sport_articles');
        $this->addSql('DROP INDEX IDX_497B315EA586286C ON utilisateurs');
        $this->addSql('ALTER TABLE utilisateurs DROP enfants_id');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231214082711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activities (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, titre_en VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, description_en LONGTEXT DEFAULT NULL, image VARCHAR(255) NOT NULL, localisation VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE faq (id INT AUTO_INCREMENT NOT NULL, question LONGTEXT NOT NULL, question_en LONGTEXT NOT NULL, response LONGTEXT NOT NULL, response_en LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, immo_id_id INT DEFAULT NULL, file VARCHAR(255) NOT NULL, INDEX IDX_E01FBE6A11FA7B31 (immo_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partners (id INT AUTO_INCREMENT NOT NULL, logo VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A11FA7B31 FOREIGN KEY (immo_id_id) REFERENCES immos (id)');
        $this->addSql('ALTER TABLE immos ADD slug VARCHAR(255) NOT NULL, CHANGE price price DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A11FA7B31');
        $this->addSql('DROP TABLE activities');
        $this->addSql('DROP TABLE faq');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE partners');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE immos DROP slug, CHANGE price price INT NOT NULL');
    }
}

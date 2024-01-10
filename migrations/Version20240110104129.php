<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240110104129 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE resrvation (id INT AUTO_INCREMENT NOT NULL, nb_animals INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activities ADD titre_es VARCHAR(255) NOT NULL, ADD description_es LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE faq ADD question_es LONGTEXT NOT NULL, ADD response_es LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE resrvation');
        $this->addSql('ALTER TABLE activities DROP titre_es, DROP description_es');
        $this->addSql('ALTER TABLE faq DROP question_es, DROP response_es');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308130517 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actualite (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, lieu VARCHAR(255) DEFAULT NULL, description CLOB NOT NULL, date DATETIME NOT NULL)');
        $this->addSql('CREATE TABLE commentaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, message CLOB NOT NULL, date DATETIME NOT NULL)');
        $this->addSql('CREATE TABLE projet (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, lien VARCHAR(255) NOT NULL, difficultes VARCHAR(255) DEFAULT NULL, date DATETIME NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE actualite');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE projet');
    }
}

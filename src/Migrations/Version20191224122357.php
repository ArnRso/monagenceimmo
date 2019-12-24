<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191224122357 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bien (id INT AUTO_INCREMENT NOT NULL, type_de_bien_id INT NOT NULL, chauffage_id INT NOT NULL, author_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, numero_rue INT NOT NULL, rue VARCHAR(255) NOT NULL, rue_complement VARCHAR(255) DEFAULT NULL, code_postal INT NOT NULL, ville VARCHAR(255) NOT NULL, surface DOUBLE PRECISION NOT NULL, nombre_de_pieces INT NOT NULL, nombre_chambres INT NOT NULL, surface_terrain DOUBLE PRECISION DEFAULT NULL, prix DOUBLE PRECISION NOT NULL, cheminee TINYINT(1) NOT NULL, belle_vue TINYINT(1) NOT NULL, balcon TINYINT(1) NOT NULL, piscine TINYINT(1) NOT NULL, ascenseur TINYINT(1) NOT NULL, terrasse TINYINT(1) NOT NULL, cave TINYINT(1) NOT NULL, parking TINYINT(1) NOT NULL, acces_handicape TINYINT(1) NOT NULL, baignoire TINYINT(1) NOT NULL, cuisine_separee TINYINT(1) NOT NULL, meuble TINYINT(1) NOT NULL, colocation TINYINT(1) NOT NULL, wc_separes TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, images LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_45EDC3869C8E58A9 (type_de_bien_id), INDEX IDX_45EDC386C9BF5A6C (chauffage_id), INDEX IDX_45EDC386F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bien ADD CONSTRAINT FK_45EDC3869C8E58A9 FOREIGN KEY (type_de_bien_id) REFERENCES type_de_bien (id)');
        $this->addSql('ALTER TABLE bien ADD CONSTRAINT FK_45EDC386C9BF5A6C FOREIGN KEY (chauffage_id) REFERENCES chauffage (id)');
        $this->addSql('ALTER TABLE bien ADD CONSTRAINT FK_45EDC386F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE bien');
    }
}

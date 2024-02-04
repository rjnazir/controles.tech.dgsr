<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240204052150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ct_vehicule (id INT AUTO_INCREMENT NOT NULL, ct_genre_id INT DEFAULT NULL, ct_marque_id INT DEFAULT NULL, vhc_cylindre VARCHAR(10) DEFAULT NULL, vhc_puissance DOUBLE PRECISION DEFAULT NULL, vhc_poids_vide DOUBLE PRECISION DEFAULT NULL, vhc_charge_utile DOUBLE PRECISION DEFAULT NULL, vhc_hauteur DOUBLE PRECISION DEFAULT NULL, vhc_largeur DOUBLE PRECISION DEFAULT NULL, vhc_longueur DOUBLE PRECISION DEFAULT NULL, vhc_num_serie VARCHAR(100) DEFAULT NULL, vhc_num_moteur VARCHAR(100) NOT NULL, vhc_provenance VARCHAR(45) DEFAULT NULL, vhc_type VARCHAR(45) DEFAULT NULL, vhc_poids_total_charge DOUBLE PRECISION DEFAULT NULL, vhc_created DATETIME DEFAULT NULL, INDEX IDX_BCF5CAE4D74CE6E6 (ct_genre_id), INDEX IDX_BCF5CAE48CD3293F (ct_marque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ct_vehicule ADD CONSTRAINT FK_BCF5CAE4D74CE6E6 FOREIGN KEY (ct_genre_id) REFERENCES ct_genre (id)');
        $this->addSql('ALTER TABLE ct_vehicule ADD CONSTRAINT FK_BCF5CAE48CD3293F FOREIGN KEY (ct_marque_id) REFERENCES ct_marque (id)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ct_vehicule DROP FOREIGN KEY FK_BCF5CAE4D74CE6E6');
        $this->addSql('ALTER TABLE ct_vehicule DROP FOREIGN KEY FK_BCF5CAE48CD3293F');
        $this->addSql('DROP TABLE ct_vehicule');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }
}

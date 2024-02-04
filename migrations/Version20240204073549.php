<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240204073549 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ct_reception CHANGE rcp_immatriculation rcp_immatriculation VARCHAR(45) DEFAULT NULL, CHANGE rcp_proprietaire rcp_proprietaire VARCHAR(255) DEFAULT NULL, CHANGE rcp_profession rcp_profession VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE ct_vehicule CHANGE vhc_num_moteur vhc_num_moteur VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE ct_vehicule RENAME INDEX fk_ct_vehicule_ct_genre1_idx TO IDX_BCF5CAE4D74CE6E6');
        $this->addSql('ALTER TABLE ct_vehicule RENAME INDEX fk_ct_vehicule_ct_marque1_idx TO IDX_BCF5CAE48CD3293F');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ct_reception CHANGE rcp_immatriculation rcp_immatriculation VARCHAR(45) NOT NULL, CHANGE rcp_proprietaire rcp_proprietaire VARCHAR(255) NOT NULL, CHANGE rcp_profession rcp_profession VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE ct_vehicule CHANGE vhc_num_moteur vhc_num_moteur VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE ct_vehicule RENAME INDEX idx_bcf5cae4d74ce6e6 TO fk_ct_vehicule_ct_genre1_idx');
        $this->addSql('ALTER TABLE ct_vehicule RENAME INDEX idx_bcf5cae48cd3293f TO fk_ct_vehicule_ct_marque1_idx');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }
}

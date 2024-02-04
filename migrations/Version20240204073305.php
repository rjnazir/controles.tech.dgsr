<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240204073305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ct_reception (id INT AUTO_INCREMENT NOT NULL, ct_centre_id INT DEFAULT NULL, ct_motif_id INT DEFAULT NULL, ct_type_reception_id INT DEFAULT NULL, ct_user_id INT DEFAULT NULL, ct_verificateur_id INT DEFAULT NULL, ct_utilisation_id INT DEFAULT NULL, ct_vehicule_id INT DEFAULT NULL, ct_source_energie_id INT DEFAULT NULL, rcp_mise_service DATETIME DEFAULT NULL, rcp_immatriculation VARCHAR(45) NOT NULL, rcp_proprietaire VARCHAR(255) NOT NULL, rcp_profession VARCHAR(100) NOT NULL, rcp_adresse VARCHAR(255) DEFAULT NULL, rcp_nbr_assis INT DEFAULT NULL, rcp_nbr_debout INT DEFAULT NULL, rcp_num_pv VARCHAR(100) DEFAULT NULL, rcp_num_group VARCHAR(255) DEFAULT NULL, is_deleted TINYINT(1) DEFAULT NULL, rcp_obs_del VARCHAR(255) DEFAULT NULL, rcp_created DATETIME DEFAULT NULL, rcp_update DATETIME DEFAULT NULL, INDEX IDX_942215A282C8474E (ct_centre_id), INDEX IDX_942215A245348DE0 (ct_motif_id), INDEX IDX_942215A24E379674 (ct_type_reception_id), INDEX IDX_942215A2C211A85D (ct_user_id), INDEX IDX_942215A2BDF4F30F (ct_verificateur_id), INDEX IDX_942215A255B81AF1 (ct_utilisation_id), INDEX IDX_942215A2346884A7 (ct_vehicule_id), INDEX IDX_942215A27EE62163 (ct_source_energie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ct_reception ADD CONSTRAINT FK_942215A282C8474E FOREIGN KEY (ct_centre_id) REFERENCES ct_centre (id)');
        $this->addSql('ALTER TABLE ct_reception ADD CONSTRAINT FK_942215A245348DE0 FOREIGN KEY (ct_motif_id) REFERENCES ct_motif (id)');
        $this->addSql('ALTER TABLE ct_reception ADD CONSTRAINT FK_942215A24E379674 FOREIGN KEY (ct_type_reception_id) REFERENCES ct_type_reception (id)');
        $this->addSql('ALTER TABLE ct_reception ADD CONSTRAINT FK_942215A2C211A85D FOREIGN KEY (ct_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE ct_reception ADD CONSTRAINT FK_942215A2BDF4F30F FOREIGN KEY (ct_verificateur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE ct_reception ADD CONSTRAINT FK_942215A255B81AF1 FOREIGN KEY (ct_utilisation_id) REFERENCES ct_utilisation (id)');
        $this->addSql('ALTER TABLE ct_reception ADD CONSTRAINT FK_942215A2346884A7 FOREIGN KEY (ct_vehicule_id) REFERENCES ct_vehicule (id)');
        $this->addSql('ALTER TABLE ct_reception ADD CONSTRAINT FK_942215A27EE62163 FOREIGN KEY (ct_source_energie_id) REFERENCES ct_source_energie (id)');
        $this->addSql('ALTER TABLE ct_vehicule CHANGE vhc_num_moteur vhc_num_moteur VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE ct_vehicule RENAME INDEX fk_ct_vehicule_ct_genre1_idx TO IDX_BCF5CAE4D74CE6E6');
        $this->addSql('ALTER TABLE ct_vehicule RENAME INDEX fk_ct_vehicule_ct_marque1_idx TO IDX_BCF5CAE48CD3293F');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ct_reception DROP FOREIGN KEY FK_942215A282C8474E');
        $this->addSql('ALTER TABLE ct_reception DROP FOREIGN KEY FK_942215A245348DE0');
        $this->addSql('ALTER TABLE ct_reception DROP FOREIGN KEY FK_942215A24E379674');
        $this->addSql('ALTER TABLE ct_reception DROP FOREIGN KEY FK_942215A2C211A85D');
        $this->addSql('ALTER TABLE ct_reception DROP FOREIGN KEY FK_942215A2BDF4F30F');
        $this->addSql('ALTER TABLE ct_reception DROP FOREIGN KEY FK_942215A255B81AF1');
        $this->addSql('ALTER TABLE ct_reception DROP FOREIGN KEY FK_942215A2346884A7');
        $this->addSql('ALTER TABLE ct_reception DROP FOREIGN KEY FK_942215A27EE62163');
        $this->addSql('DROP TABLE ct_reception');
        $this->addSql('ALTER TABLE ct_vehicule CHANGE vhc_num_moteur vhc_num_moteur VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE ct_vehicule RENAME INDEX idx_bcf5cae4d74ce6e6 TO fk_ct_vehicule_ct_genre1_idx');
        $this->addSql('ALTER TABLE ct_vehicule RENAME INDEX idx_bcf5cae48cd3293f TO fk_ct_vehicule_ct_marque1_idx');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }
}

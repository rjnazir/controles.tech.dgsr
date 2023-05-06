<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230504103302 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ct_motif_tarif (id INT AUTO_INCREMENT NOT NULL, ct_motif_id INT DEFAULT NULL, ct_arrete_prix_id INT DEFAULT NULL, mtf_trf_prix DOUBLE PRECISION DEFAULT NULL, mtf_trf_date VARCHAR(4) DEFAULT NULL, INDEX IDX_110F10F845348DE0 (ct_motif_id), INDEX IDX_110F10F876255A68 (ct_arrete_prix_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ct_motif_tarif ADD CONSTRAINT FK_110F10F845348DE0 FOREIGN KEY (ct_motif_id) REFERENCES ct_motif (id)');
        $this->addSql('ALTER TABLE ct_motif_tarif ADD CONSTRAINT FK_110F10F876255A68 FOREIGN KEY (ct_arrete_prix_id) REFERENCES ct_arrete_prix (id)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ct_motif_tarif DROP FOREIGN KEY FK_110F10F845348DE0');
        $this->addSql('ALTER TABLE ct_motif_tarif DROP FOREIGN KEY FK_110F10F876255A68');
        $this->addSql('DROP TABLE ct_motif_tarif');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }
}

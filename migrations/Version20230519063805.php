<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230519063805 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ct_visite_extra_tarif (id INT AUTO_INCREMENT NOT NULL, ct_arrete_prix_id INT DEFAULT NULL, ct_visite_extra_id INT DEFAULT NULL, vet_annee VARCHAR(4) DEFAULT NULL, vet_prix DOUBLE PRECISION DEFAULT NULL, INDEX IDX_E3F1985E76255A68 (ct_arrete_prix_id), INDEX IDX_E3F1985E15D88434 (ct_visite_extra_id), UNIQUE INDEX UNIQ_E3F1985E76255A6815D88434 (ct_arrete_prix_id, ct_visite_extra_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ct_visite_extra_tarif ADD CONSTRAINT FK_E3F1985E76255A68 FOREIGN KEY (ct_arrete_prix_id) REFERENCES ct_arrete_prix (id)');
        $this->addSql('ALTER TABLE ct_visite_extra_tarif ADD CONSTRAINT FK_E3F1985E15D88434 FOREIGN KEY (ct_visite_extra_id) REFERENCES ct_visite_extra (id)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ct_visite_extra_tarif DROP FOREIGN KEY FK_E3F1985E76255A68');
        $this->addSql('ALTER TABLE ct_visite_extra_tarif DROP FOREIGN KEY FK_E3F1985E15D88434');
        $this->addSql('DROP TABLE ct_visite_extra_tarif');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }
}

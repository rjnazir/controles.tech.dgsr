<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230505094317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX ct_motif_tarif ON ct_motif_tarif');
        $this->addSql('CREATE UNIQUE INDEX ct_motif_tarif ON ct_motif_tarif (ct_arrete_prix_id, ct_motif_id, mtf_trf_date, mtf_trf_prix)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX ct_motif_tarif ON ct_motif_tarif');
        $this->addSql('CREATE UNIQUE INDEX ct_motif_tarif ON ct_motif_tarif (mtf_trf_prix, mtf_trf_date, ct_motif_id, ct_arrete_prix_id)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }
}

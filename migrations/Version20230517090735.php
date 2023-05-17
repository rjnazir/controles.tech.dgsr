<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230517090735 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ct_proces_verbal (id INT AUTO_INCREMENT NOT NULL, ct_arrete_prix_id INT DEFAULT NULL, pv_type VARCHAR(255) DEFAULT NULL, pv_tarif DOUBLE PRECISION DEFAULT NULL, INDEX IDX_556CD10D76255A68 (ct_arrete_prix_id), UNIQUE INDEX UNIQ_556CD10D76255A68BBA631A6 (ct_arrete_prix_id, pv_type), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ct_proces_verbal ADD CONSTRAINT FK_556CD10D76255A68 FOREIGN KEY (ct_arrete_prix_id) REFERENCES ct_arrete_prix (id)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ct_proces_verbal DROP FOREIGN KEY FK_556CD10D76255A68');
        $this->addSql('DROP TABLE ct_proces_verbal');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }
}

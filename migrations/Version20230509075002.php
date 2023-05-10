<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230509075002 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ct_usage_tarif (id INT AUTO_INCREMENT NOT NULL, ct_usage_id INT DEFAULT NULL, ct_type_visite_id INT DEFAULT NULL, ct_arrete_prix_id INT DEFAULT NULL, usg_trf_annee VARCHAR(4) DEFAULT NULL, usg_trf_prix DOUBLE PRECISION DEFAULT NULL, INDEX IDX_FA9D5B81B48AD363 (ct_usage_id), INDEX IDX_FA9D5B819C6EC188 (ct_type_visite_id), INDEX IDX_FA9D5B8176255A68 (ct_arrete_prix_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ct_usage_tarif ADD CONSTRAINT FK_FA9D5B81B48AD363 FOREIGN KEY (ct_usage_id) REFERENCES ct_usage (id)');
        $this->addSql('ALTER TABLE ct_usage_tarif ADD CONSTRAINT FK_FA9D5B819C6EC188 FOREIGN KEY (ct_type_visite_id) REFERENCES ct_type_visite (id)');
        $this->addSql('ALTER TABLE ct_usage_tarif ADD CONSTRAINT FK_FA9D5B8176255A68 FOREIGN KEY (ct_arrete_prix_id) REFERENCES ct_arrete_prix (id)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ct_usage_tarif DROP FOREIGN KEY FK_FA9D5B81B48AD363');
        $this->addSql('ALTER TABLE ct_usage_tarif DROP FOREIGN KEY FK_FA9D5B819C6EC188');
        $this->addSql('ALTER TABLE ct_usage_tarif DROP FOREIGN KEY FK_FA9D5B8176255A68');
        $this->addSql('DROP TABLE ct_usage_tarif');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }
}

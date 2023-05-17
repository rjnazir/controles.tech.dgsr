<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230517072213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ct_droit_ptac (id INT AUTO_INCREMENT NOT NULL, ct_genre_categorie_id INT DEFAULT NULL, ct_type_droit_ptac_id INT DEFAULT NULL, ct_arrete_prix_id INT DEFAULT NULL, dp_poids_min DOUBLE PRECISION DEFAULT NULL, dp_poids_max DOUBLE PRECISION DEFAULT NULL, dp_droit DOUBLE PRECISION DEFAULT NULL, INDEX IDX_DB918ADA12DA9529 (ct_genre_categorie_id), INDEX IDX_DB918ADA7CFDF4AC (ct_type_droit_ptac_id), INDEX IDX_DB918ADA76255A68 (ct_arrete_prix_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ct_droit_ptac ADD CONSTRAINT FK_DB918ADA12DA9529 FOREIGN KEY (ct_genre_categorie_id) REFERENCES ct_genre_categorie (id)');
        $this->addSql('ALTER TABLE ct_droit_ptac ADD CONSTRAINT FK_DB918ADA7CFDF4AC FOREIGN KEY (ct_type_droit_ptac_id) REFERENCES ct_type_droit_ptac (id)');
        $this->addSql('ALTER TABLE ct_droit_ptac ADD CONSTRAINT FK_DB918ADA76255A68 FOREIGN KEY (ct_arrete_prix_id) REFERENCES ct_arrete_prix (id)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ct_droit_ptac DROP FOREIGN KEY FK_DB918ADA12DA9529');
        $this->addSql('ALTER TABLE ct_droit_ptac DROP FOREIGN KEY FK_DB918ADA7CFDF4AC');
        $this->addSql('ALTER TABLE ct_droit_ptac DROP FOREIGN KEY FK_DB918ADA76255A68');
        $this->addSql('DROP TABLE ct_droit_ptac');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230605072510 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ct_bordereau DROP FOREIGN KEY FK_334055EC2ADBF4F2');
        $this->addSql('DROP INDEX IDX_334055EC2ADBF4F2 ON ct_bordereau');
        $this->addSql('ALTER TABLE ct_bordereau DROP ct_imprime_tech_id, DROP be_debut_numero, DROP be_fin_numero');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_334055EC82C8474E9D92CA30 ON ct_bordereau (ct_centre_id, be_numero)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F32A351F82C8474ED600094F ON ct_expression_besoin (ct_centre_id, edb_numero)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_334055EC82C8474E9D92CA30 ON ct_bordereau');
        $this->addSql('ALTER TABLE ct_bordereau ADD ct_imprime_tech_id INT DEFAULT NULL, ADD be_debut_numero INT DEFAULT NULL, ADD be_fin_numero INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ct_bordereau ADD CONSTRAINT FK_334055EC2ADBF4F2 FOREIGN KEY (ct_imprime_tech_id) REFERENCES ct_imprime_tech (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_334055EC2ADBF4F2 ON ct_bordereau (ct_imprime_tech_id)');
        $this->addSql('DROP INDEX UNIQ_F32A351F82C8474ED600094F ON ct_expression_besoin');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }
}

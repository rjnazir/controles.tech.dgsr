<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230605071548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ct_expression_besoin DROP FOREIGN KEY FK_F32A351F2ADBF4F2');
        $this->addSql('DROP INDEX IDX_F32A351F2ADBF4F2 ON ct_expression_besoin');
        $this->addSql('DROP INDEX UNIQ_F32A351F82C8474E2ADBF4F2D600094F ON ct_expression_besoin');
        $this->addSql('ALTER TABLE ct_expression_besoin DROP ct_imprime_tech_id, DROP edb_qte_demander');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F32A351F82C8474ED600094F ON ct_expression_besoin (ct_centre_id, edb_numero)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_F32A351F82C8474ED600094F ON ct_expression_besoin');
        $this->addSql('ALTER TABLE ct_expression_besoin ADD ct_imprime_tech_id INT DEFAULT NULL, ADD edb_qte_demander INT NOT NULL');
        $this->addSql('ALTER TABLE ct_expression_besoin ADD CONSTRAINT FK_F32A351F2ADBF4F2 FOREIGN KEY (ct_imprime_tech_id) REFERENCES ct_imprime_tech (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_F32A351F2ADBF4F2 ON ct_expression_besoin (ct_imprime_tech_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F32A351F82C8474E2ADBF4F2D600094F ON ct_expression_besoin (ct_centre_id, ct_imprime_tech_id, edb_numero)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }
}

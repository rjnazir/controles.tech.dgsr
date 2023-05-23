<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230523070511 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ct_expression_besoin (id INT AUTO_INCREMENT NOT NULL, ct_centre_id INT DEFAULT NULL, ct_imprime_tech_id INT DEFAULT NULL, user_id INT DEFAULT NULL, edb_numero INT NOT NULL, edb_date_edit DATE NOT NULL, edb_qte_demander INT NOT NULL, edb_created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', edb_updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_F32A351F82C8474E (ct_centre_id), INDEX IDX_F32A351F2ADBF4F2 (ct_imprime_tech_id), INDEX IDX_F32A351FA76ED395 (user_id), UNIQUE INDEX UNIQ_F32A351F82C8474E2ADBF4F2D600094F (ct_centre_id, ct_imprime_tech_id, edb_numero), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ct_expression_besoin ADD CONSTRAINT FK_F32A351F82C8474E FOREIGN KEY (ct_centre_id) REFERENCES ct_centre (id)');
        $this->addSql('ALTER TABLE ct_expression_besoin ADD CONSTRAINT FK_F32A351F2ADBF4F2 FOREIGN KEY (ct_imprime_tech_id) REFERENCES ct_imprime_tech (id)');
        $this->addSql('ALTER TABLE ct_expression_besoin ADD CONSTRAINT FK_F32A351FA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ct_expression_besoin DROP FOREIGN KEY FK_F32A351F82C8474E');
        $this->addSql('ALTER TABLE ct_expression_besoin DROP FOREIGN KEY FK_F32A351F2ADBF4F2');
        $this->addSql('ALTER TABLE ct_expression_besoin DROP FOREIGN KEY FK_F32A351FA76ED395');
        $this->addSql('DROP TABLE ct_expression_besoin');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }
}

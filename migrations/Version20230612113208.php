<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230612113208 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ct_contenu ADD ct_expression_besoin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ct_contenu ADD CONSTRAINT FK_ECBD7BF78B12AEE FOREIGN KEY (ct_expression_besoin_id) REFERENCES ct_expression_besoin (id)');
        $this->addSql('CREATE INDEX IDX_ECBD7BF78B12AEE ON ct_contenu (ct_expression_besoin_id)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ct_contenu DROP FOREIGN KEY FK_ECBD7BF78B12AEE');
        $this->addSql('DROP INDEX IDX_ECBD7BF78B12AEE ON ct_contenu');
        $this->addSql('ALTER TABLE ct_contenu DROP ct_expression_besoin_id');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }
}

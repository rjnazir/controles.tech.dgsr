<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230613091238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ct_bordereau DROP INDEX IDX_334055EC8B12AEE, ADD UNIQUE INDEX UNIQ_334055EC8B12AEE (ct_expression_besoin_id)');
        $this->addSql('ALTER TABLE ct_bordereau ADD ct_contenu_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ct_bordereau ADD CONSTRAINT FK_334055ECAFD1CF85 FOREIGN KEY (ct_contenu_id) REFERENCES ct_contenu (id)');
        $this->addSql('CREATE INDEX IDX_334055ECAFD1CF85 ON ct_bordereau (ct_contenu_id)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ct_bordereau DROP INDEX UNIQ_334055EC8B12AEE, ADD INDEX IDX_334055EC8B12AEE (ct_expression_besoin_id)');
        $this->addSql('ALTER TABLE ct_bordereau DROP FOREIGN KEY FK_334055ECAFD1CF85');
        $this->addSql('DROP INDEX IDX_334055ECAFD1CF85 ON ct_bordereau');
        $this->addSql('ALTER TABLE ct_bordereau DROP ct_contenu_id');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }
}

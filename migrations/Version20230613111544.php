<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230613111544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ct_contenu ADD ct_bordereau_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ct_contenu ADD CONSTRAINT FK_ECBD7BF777A90446 FOREIGN KEY (ct_bordereau_id) REFERENCES ct_bordereau (id)');
        $this->addSql('CREATE INDEX IDX_ECBD7BF777A90446 ON ct_contenu (ct_bordereau_id)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ct_contenu DROP FOREIGN KEY FK_ECBD7BF777A90446');
        $this->addSql('DROP INDEX IDX_ECBD7BF777A90446 ON ct_contenu');
        $this->addSql('ALTER TABLE ct_contenu DROP ct_bordereau_id');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }
}

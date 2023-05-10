<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230508081751 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ct_usage (id INT AUTO_INCREMENT NOT NULL, ct_type_usage_id INT DEFAULT NULL, usg_libelle VARCHAR(255) DEFAULT NULL, usg_validite VARCHAR(255) DEFAULT NULL, usg_created DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_C8709F46E2563560 (ct_type_usage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ct_usage ADD CONSTRAINT FK_C8709F46E2563560 FOREIGN KEY (ct_type_usage_id) REFERENCES ct_type_usage (id)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ct_usage DROP FOREIGN KEY FK_C8709F46E2563560');
        $this->addSql('DROP TABLE ct_usage');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }
}

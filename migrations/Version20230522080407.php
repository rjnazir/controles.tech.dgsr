<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230522080407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ct_imprime_tech (id INT AUTO_INCREMENT NOT NULL, ct_user_id INT DEFAULT NULL, nom_imprime_tech VARCHAR(128) NOT NULL, unite_imprime_tech VARCHAR(64) NOT NULL, abrev_imprime_tech VARCHAR(64) DEFAULT NULL, prtt_created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', prtt_updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_3F49AE42C211A85D (ct_user_id), UNIQUE INDEX UNIQ_3F49AE4290F3F7145036F6C9BB935DB5 (nom_imprime_tech, unite_imprime_tech, abrev_imprime_tech), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ct_imprime_tech ADD CONSTRAINT FK_3F49AE42C211A85D FOREIGN KEY (ct_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ct_imprime_tech DROP FOREIGN KEY FK_3F49AE42C211A85D');
        $this->addSql('DROP TABLE ct_imprime_tech');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }
}

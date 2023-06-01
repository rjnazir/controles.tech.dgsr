<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230601092606 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ct_bordereau (id INT AUTO_INCREMENT NOT NULL, ct_centre_id INT DEFAULT NULL, ct_imprime_tech_id INT DEFAULT NULL, ct_expression_besoin_id INT DEFAULT NULL, user_id INT DEFAULT NULL, be_numero VARCHAR(124) NOT NULL, be_debut_numero INT DEFAULT NULL, be_fin_numero INT DEFAULT NULL, be_created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', be_updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_334055EC82C8474E (ct_centre_id), INDEX IDX_334055EC2ADBF4F2 (ct_imprime_tech_id), INDEX IDX_334055EC8B12AEE (ct_expression_besoin_id), INDEX IDX_334055ECA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ct_bordereau ADD CONSTRAINT FK_334055EC82C8474E FOREIGN KEY (ct_centre_id) REFERENCES ct_centre (id)');
        $this->addSql('ALTER TABLE ct_bordereau ADD CONSTRAINT FK_334055EC2ADBF4F2 FOREIGN KEY (ct_imprime_tech_id) REFERENCES ct_imprime_tech (id)');
        $this->addSql('ALTER TABLE ct_bordereau ADD CONSTRAINT FK_334055EC8B12AEE FOREIGN KEY (ct_expression_besoin_id) REFERENCES ct_expression_besoin (id)');
        $this->addSql('ALTER TABLE ct_bordereau ADD CONSTRAINT FK_334055ECA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ct_bordereau DROP FOREIGN KEY FK_334055EC82C8474E');
        $this->addSql('ALTER TABLE ct_bordereau DROP FOREIGN KEY FK_334055EC2ADBF4F2');
        $this->addSql('ALTER TABLE ct_bordereau DROP FOREIGN KEY FK_334055EC8B12AEE');
        $this->addSql('ALTER TABLE ct_bordereau DROP FOREIGN KEY FK_334055ECA76ED395');
        $this->addSql('DROP TABLE ct_bordereau');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }
}

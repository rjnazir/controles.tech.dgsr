<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230605073423 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ct_contenu (id INT AUTO_INCREMENT NOT NULL, ct_imprime_tech_id INT DEFAULT NULL, qte_demande DOUBLE PRECISION NOT NULL, debut_numero DOUBLE PRECISION DEFAULT NULL, fin_numero DOUBLE PRECISION DEFAULT NULL, INDEX IDX_ECBD7BF72ADBF4F2 (ct_imprime_tech_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_contenu_ct_bordereau (ct_contenu_id INT NOT NULL, ct_bordereau_id INT NOT NULL, INDEX IDX_E2EF930FAFD1CF85 (ct_contenu_id), INDEX IDX_E2EF930F77A90446 (ct_bordereau_id), PRIMARY KEY(ct_contenu_id, ct_bordereau_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct_contenu_ct_expression_besoin (ct_contenu_id INT NOT NULL, ct_expression_besoin_id INT NOT NULL, INDEX IDX_D6748FEAFD1CF85 (ct_contenu_id), INDEX IDX_D6748FE8B12AEE (ct_expression_besoin_id), PRIMARY KEY(ct_contenu_id, ct_expression_besoin_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ct_contenu ADD CONSTRAINT FK_ECBD7BF72ADBF4F2 FOREIGN KEY (ct_imprime_tech_id) REFERENCES ct_imprime_tech (id)');
        $this->addSql('ALTER TABLE ct_contenu_ct_bordereau ADD CONSTRAINT FK_E2EF930FAFD1CF85 FOREIGN KEY (ct_contenu_id) REFERENCES ct_contenu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ct_contenu_ct_bordereau ADD CONSTRAINT FK_E2EF930F77A90446 FOREIGN KEY (ct_bordereau_id) REFERENCES ct_bordereau (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ct_contenu_ct_expression_besoin ADD CONSTRAINT FK_D6748FEAFD1CF85 FOREIGN KEY (ct_contenu_id) REFERENCES ct_contenu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ct_contenu_ct_expression_besoin ADD CONSTRAINT FK_D6748FE8B12AEE FOREIGN KEY (ct_expression_besoin_id) REFERENCES ct_expression_besoin (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ct_contenu DROP FOREIGN KEY FK_ECBD7BF72ADBF4F2');
        $this->addSql('ALTER TABLE ct_contenu_ct_bordereau DROP FOREIGN KEY FK_E2EF930FAFD1CF85');
        $this->addSql('ALTER TABLE ct_contenu_ct_bordereau DROP FOREIGN KEY FK_E2EF930F77A90446');
        $this->addSql('ALTER TABLE ct_contenu_ct_expression_besoin DROP FOREIGN KEY FK_D6748FEAFD1CF85');
        $this->addSql('ALTER TABLE ct_contenu_ct_expression_besoin DROP FOREIGN KEY FK_D6748FE8B12AEE');
        $this->addSql('DROP TABLE ct_contenu');
        $this->addSql('DROP TABLE ct_contenu_ct_bordereau');
        $this->addSql('DROP TABLE ct_contenu_ct_expression_besoin');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }
}

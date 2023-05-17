<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230515082803 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ct_genre (id INT AUTO_INCREMENT NOT NULL, ct_genre_categorie_id INT DEFAULT NULL, gr_libelle VARCHAR(255) DEFAULT NULL, gr_code VARCHAR(50) DEFAULT NULL, INDEX IDX_9BCBF2CE12DA9529 (ct_genre_categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ct_genre ADD CONSTRAINT FK_9BCBF2CE12DA9529 FOREIGN KEY (ct_genre_categorie_id) REFERENCES ct_genre_categorie (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1094DB80E3F353 ON ct_genre_categorie (gc_libelle)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ct_genre DROP FOREIGN KEY FK_9BCBF2CE12DA9529');
        $this->addSql('DROP TABLE ct_genre');
        $this->addSql('DROP INDEX UNIQ_1094DB80E3F353 ON ct_genre_categorie');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }
}

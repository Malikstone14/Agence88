<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230914152804 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_280C06F56C6E55B5 ON gh');
        $this->addSql('ALTER TABLE gh CHANGE nom nom VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX UNIQ_3F9260AB6C6E55B5 ON ghu');
        $this->addSql('ALTER TABLE ghu CHANGE nom nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD ghu_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649C890EE41 FOREIGN KEY (ghu_id) REFERENCES `ghu` (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649C890EE41 ON user (ghu_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `gh` CHANGE nom nom VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_280C06F56C6E55B5 ON `gh` (nom)');
        $this->addSql('ALTER TABLE `ghu` CHANGE nom nom VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3F9260AB6C6E55B5 ON `ghu` (nom)');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649C890EE41');
        $this->addSql('DROP INDEX IDX_8D93D649C890EE41 ON `user`');
        $this->addSql('ALTER TABLE `user` DROP ghu_id');
    }
}

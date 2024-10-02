<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241002125521 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sweatshirt (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, size LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sweatshirt_size (id INT AUTO_INCREMENT NOT NULL, sweatshirt_relation_id INT DEFAULT NULL, size VARCHAR(255) NOT NULL, stock INT NOT NULL, INDEX IDX_136249E26E3F33D3 (sweatshirt_relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sweatshirt_size ADD CONSTRAINT FK_136249E26E3F33D3 FOREIGN KEY (sweatshirt_relation_id) REFERENCES sweatshirt (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sweatshirt_size DROP FOREIGN KEY FK_136249E26E3F33D3');
        $this->addSql('DROP TABLE sweatshirt');
        $this->addSql('DROP TABLE sweatshirt_size');
    }
}

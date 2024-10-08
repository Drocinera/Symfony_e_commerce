<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241008130016 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sweatshirt_size ADD CONSTRAINT FK_136249E2A143AB7B FOREIGN KEY (sweatshirt_id) REFERENCES sweatshirt (id)');
        $this->addSql('CREATE INDEX IDX_136249E2A143AB7B ON sweatshirt_size (sweatshirt_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sweatshirt_size DROP FOREIGN KEY FK_136249E2A143AB7B');
        $this->addSql('DROP INDEX IDX_136249E2A143AB7B ON sweatshirt_size');
    }
}

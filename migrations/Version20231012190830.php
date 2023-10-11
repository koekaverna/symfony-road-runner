<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231012190830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE currency_quote (id UUID NOT NULL, import_id UUID DEFAULT NULL, base VARCHAR(5) NOT NULL, quote VARCHAR(5) NOT NULL, rate DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3C93C992B6A263D9 ON currency_quote (import_id)');
        $this->addSql('COMMENT ON COLUMN currency_quote.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN currency_quote.import_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE import (id UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, provider VARCHAR(255) NOT NULL, base VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN import.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN import.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE currency_quote ADD CONSTRAINT FK_3C93C992B6A263D9 FOREIGN KEY (import_id) REFERENCES import (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE currency_quote DROP CONSTRAINT FK_3C93C992B6A263D9');
        $this->addSql('DROP TABLE currency_quote');
        $this->addSql('DROP TABLE import');
    }
}

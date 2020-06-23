<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200511104215 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE orders CHANGE ship_region ship_region INT DEFAULT NULL');
        $this->addSql('ALTER TABLE products ADD supplier_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5AA65F9C7D FOREIGN KEY (supplier_id_id) REFERENCES suppliers (id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5AA65F9C7D ON products (supplier_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE orders CHANGE ship_region ship_region VARCHAR(15) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5AA65F9C7D');
        $this->addSql('DROP INDEX IDX_B3BA5A5AA65F9C7D ON products');
        $this->addSql('ALTER TABLE products DROP supplier_id_id');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200618134632 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comments ADD id_product_id INT NOT NULL, ADD id_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AE00EE68D FOREIGN KEY (id_product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5F9E962AE00EE68D ON comments (id_product_id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A79F37AE5 ON comments (id_user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AE00EE68D');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A79F37AE5');
        $this->addSql('DROP INDEX IDX_5F9E962AE00EE68D ON comments');
        $this->addSql('DROP INDEX IDX_5F9E962A79F37AE5 ON comments');
        $this->addSql('ALTER TABLE comments DROP id_product_id, DROP id_user_id');
    }
}

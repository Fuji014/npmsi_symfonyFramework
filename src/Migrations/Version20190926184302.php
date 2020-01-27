<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190926184302 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ship_type DROP FOREIGN KEY FK_2EFC8468700047D2');
        $this->addSql('DROP INDEX IDX_2EFC8468700047D2 ON ship_type');
        $this->addSql('ALTER TABLE ship_type DROP ticket_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ship_type ADD ticket_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ship_type ADD CONSTRAINT FK_2EFC8468700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id)');
        $this->addSql('CREATE INDEX IDX_2EFC8468700047D2 ON ship_type (ticket_id)');
    }
}

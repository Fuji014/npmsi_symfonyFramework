<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190926205014 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE shiptype DROP FOREIGN KEY FK_84177DF01DD60056');
        $this->addSql('ALTER TABLE shiptype DROP FOREIGN KEY FK_84177DF06DCD3267');
        $this->addSql('DROP TABLE shipschedule');
        $this->addSql('DROP TABLE shipticket');
        $this->addSql('DROP INDEX IDX_84177DF01DD60056 ON shiptype');
        $this->addSql('DROP INDEX IDX_84177DF06DCD3267 ON shiptype');
        $this->addSql('ALTER TABLE shiptype DROP shipschedule_id, DROP shipticket_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE shipschedule (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE shipticket (id INT AUTO_INCREMENT NOT NULL, fullfare VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, studentfare VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, seniorfare VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, pwdfare VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE shiptype ADD shipschedule_id INT DEFAULT NULL, ADD shipticket_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE shiptype ADD CONSTRAINT FK_84177DF01DD60056 FOREIGN KEY (shipschedule_id) REFERENCES shipschedule (id)');
        $this->addSql('ALTER TABLE shiptype ADD CONSTRAINT FK_84177DF06DCD3267 FOREIGN KEY (shipticket_id) REFERENCES shipticket (id)');
        $this->addSql('CREATE INDEX IDX_84177DF01DD60056 ON shiptype (shipschedule_id)');
        $this->addSql('CREATE INDEX IDX_84177DF06DCD3267 ON shiptype (shipticket_id)');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190926191520 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE shipschedule (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shipticket (id INT AUTO_INCREMENT NOT NULL, fullfare VARCHAR(255) NOT NULL, studentfare VARCHAR(255) NOT NULL, seniorfare VARCHAR(255) NOT NULL, pwdfare VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shiptype (id INT AUTO_INCREMENT NOT NULL, shipschedule_id INT DEFAULT NULL, shipticket_id INT DEFAULT NULL, shipname VARCHAR(255) NOT NULL, shipcontent VARCHAR(255) NOT NULL, INDEX IDX_84177DF01DD60056 (shipschedule_id), INDEX IDX_84177DF06DCD3267 (shipticket_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shiptype ADD CONSTRAINT FK_84177DF01DD60056 FOREIGN KEY (shipschedule_id) REFERENCES shipschedule (id)');
        $this->addSql('ALTER TABLE shiptype ADD CONSTRAINT FK_84177DF06DCD3267 FOREIGN KEY (shipticket_id) REFERENCES shipticket (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE shiptype DROP FOREIGN KEY FK_84177DF01DD60056');
        $this->addSql('ALTER TABLE shiptype DROP FOREIGN KEY FK_84177DF06DCD3267');
        $this->addSql('DROP TABLE shipschedule');
        $this->addSql('DROP TABLE shipticket');
        $this->addSql('DROP TABLE shiptype');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190926223220 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE shipschedule (id INT AUTO_INCREMENT NOT NULL, shiptype_id INT NOT NULL, leavingtime VARCHAR(255) NOT NULL, INDEX IDX_205DC0EBCAC73418 (shiptype_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shipticket (id INT AUTO_INCREMENT NOT NULL, shiptype_id INT DEFAULT NULL, fullfare VARCHAR(255) NOT NULL, studentfare VARCHAR(255) NOT NULL, seniorfare VARCHAR(255) NOT NULL, pwdfare VARCHAR(255) NOT NULL, INDEX IDX_1CE112EACAC73418 (shiptype_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shipschedule ADD CONSTRAINT FK_205DC0EBCAC73418 FOREIGN KEY (shiptype_id) REFERENCES shiptype (id)');
        $this->addSql('ALTER TABLE shipticket ADD CONSTRAINT FK_1CE112EACAC73418 FOREIGN KEY (shiptype_id) REFERENCES shiptype (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE shipschedule');
        $this->addSql('DROP TABLE shipticket');
    }
}

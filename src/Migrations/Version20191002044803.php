<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191002044803 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE contactus (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, subject VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shipticket (id INT AUTO_INCREMENT NOT NULL, shiptype_id INT DEFAULT NULL, fullfare VARCHAR(255) NOT NULL, studentfare VARCHAR(255) NOT NULL, seniorfare VARCHAR(255) NOT NULL, pwdfare VARCHAR(255) NOT NULL, INDEX IDX_1CE112EACAC73418 (shiptype_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shiptype (id INT AUTO_INCREMENT NOT NULL, shipname VARCHAR(255) NOT NULL, shipcontent VARCHAR(255) NOT NULL, shipimage VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shipschedule (id INT AUTO_INCREMENT NOT NULL, shiptype_id INT NOT NULL, leavingtime VARCHAR(255) NOT NULL, INDEX IDX_205DC0EBCAC73418 (shiptype_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE email (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, gmailto VARCHAR(255) NOT NULL, gmailfrom VARCHAR(255) NOT NULL, subject VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, body VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shipticket ADD CONSTRAINT FK_1CE112EACAC73418 FOREIGN KEY (shiptype_id) REFERENCES shiptype (id)');
        $this->addSql('ALTER TABLE shipschedule ADD CONSTRAINT FK_205DC0EBCAC73418 FOREIGN KEY (shiptype_id) REFERENCES shiptype (id)');
        $this->addSql('ALTER TABLE comment ADD email VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE shipticket DROP FOREIGN KEY FK_1CE112EACAC73418');
        $this->addSql('ALTER TABLE shipschedule DROP FOREIGN KEY FK_205DC0EBCAC73418');
        $this->addSql('DROP TABLE contactus');
        $this->addSql('DROP TABLE shipticket');
        $this->addSql('DROP TABLE shiptype');
        $this->addSql('DROP TABLE shipschedule');
        $this->addSql('DROP TABLE email');
        $this->addSql('ALTER TABLE comment DROP email');
    }
}

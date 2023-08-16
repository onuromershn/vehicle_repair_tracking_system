<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230816195521 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, phone_number INT NOT NULL, address LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_info (id INT AUTO_INCREMENT NOT NULL, customer_id_id INT NOT NULL, customer_id INT NOT NULL, INDEX IDX_5CA85BBB171EB6C (customer_id_id), INDEX IDX_5CA85BB9395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE service_info ADD CONSTRAINT FK_5CA85BBB171EB6C FOREIGN KEY (customer_id_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE service_info ADD CONSTRAINT FK_5CA85BB9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service_info DROP FOREIGN KEY FK_5CA85BBB171EB6C');
        $this->addSql('ALTER TABLE service_info DROP FOREIGN KEY FK_5CA85BB9395C3F3');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE service_info');
    }
}

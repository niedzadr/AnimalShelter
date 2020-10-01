<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200929143825 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, color_id INT NOT NULL, breed_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, admission_date DATETIME NOT NULL, year_of_birth INT NOT NULL, weigth DOUBLE PRECISION NOT NULL, height DOUBLE PRECISION NOT NULL, length DOUBLE PRECISION NOT NULL, INDEX IDX_6AAB231F7ADA1FB5 (color_id), INDEX IDX_6AAB231FA8B4A30F (breed_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE breed (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE color (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, value INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F7ADA1FB5 FOREIGN KEY (color_id) REFERENCES color (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FA8B4A30F FOREIGN KEY (breed_id) REFERENCES breed (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FA8B4A30F');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F7ADA1FB5');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE breed');
        $this->addSql('DROP TABLE color');
    }
}

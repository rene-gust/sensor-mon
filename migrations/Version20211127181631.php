<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211127181631 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sensor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sensor_record (id INT AUTO_INCREMENT NOT NULL, sensor_id INT NOT NULL, unit_id INT NOT NULL, value DOUBLE PRECISION NOT NULL, date_time DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_35A3B181A247991F (sensor_id), INDEX IDX_35A3B181F8BD700D (unit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sensor_record_unit (id INT AUTO_INCREMENT NOT NULL, si_base_unit VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sensor_record ADD CONSTRAINT FK_35A3B181A247991F FOREIGN KEY (sensor_id) REFERENCES sensor (id)');
        $this->addSql('ALTER TABLE sensor_record ADD CONSTRAINT FK_35A3B181F8BD700D FOREIGN KEY (unit_id) REFERENCES sensor_record_unit (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sensor_record DROP FOREIGN KEY FK_35A3B181A247991F');
        $this->addSql('ALTER TABLE sensor_record DROP FOREIGN KEY FK_35A3B181F8BD700D');
        $this->addSql('DROP TABLE sensor');
        $this->addSql('DROP TABLE sensor_record');
        $this->addSql('DROP TABLE sensor_record_unit');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191003113155 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE daily_forecast (id INT AUTO_INCREMENT NOT NULL, forecast_id_id INT NOT NULL, date DATETIME NOT NULL, min INT NOT NULL, max INT NOT NULL, day LONGTEXT DEFAULT NULL, night LONGTEXT DEFAULT NULL, INDEX IDX_9093AF906A5B0C95 (forecast_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forecast (id INT AUTO_INCREMENT NOT NULL, city_id_id INT NOT NULL, date DATETIME NOT NULL, end DATETIME NOT NULL, text LONGTEXT DEFAULT NULL, INDEX IDX_2A9C78443CCE3900 (city_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE daily_forecast ADD CONSTRAINT FK_9093AF906A5B0C95 FOREIGN KEY (forecast_id_id) REFERENCES forecast (id)');
        $this->addSql('ALTER TABLE forecast ADD CONSTRAINT FK_2A9C78443CCE3900 FOREIGN KEY (city_id_id) REFERENCES city (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE forecast DROP FOREIGN KEY FK_2A9C78443CCE3900');
        $this->addSql('ALTER TABLE daily_forecast DROP FOREIGN KEY FK_9093AF906A5B0C95');
        $this->addSql('DROP TABLE daily_forecast');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE forecast');
    }
}

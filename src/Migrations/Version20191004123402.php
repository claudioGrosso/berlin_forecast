<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191004123402 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE weather (id INT AUTO_INCREMENT NOT NULL, daily_forecast_id INT NOT NULL, light VARCHAR(255) NOT NULL, phrase VARCHAR(255) NOT NULL, precipitation TINYINT(1) NOT NULL, type VARCHAR(255) NOT NULL, intensity VARCHAR(255) NOT NULL, INDEX IDX_4CD0D36EDBCB1F88 (daily_forecast_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE daily_forecast (id INT AUTO_INCREMENT NOT NULL, forecast_id INT NOT NULL, date INT NOT NULL, min INT NOT NULL, max INT NOT NULL, INDEX IDX_9093AF90F8DCC97 (forecast_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forecast (id INT AUTO_INCREMENT NOT NULL, date INT NOT NULL, text VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE weather ADD CONSTRAINT FK_4CD0D36EDBCB1F88 FOREIGN KEY (daily_forecast_id) REFERENCES daily_forecast (id)');
        $this->addSql('ALTER TABLE daily_forecast ADD CONSTRAINT FK_9093AF90F8DCC97 FOREIGN KEY (forecast_id) REFERENCES forecast (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE weather DROP FOREIGN KEY FK_4CD0D36EDBCB1F88');
        $this->addSql('ALTER TABLE daily_forecast DROP FOREIGN KEY FK_9093AF90F8DCC97');
        $this->addSql('DROP TABLE weather');
        $this->addSql('DROP TABLE daily_forecast');
        $this->addSql('DROP TABLE forecast');
    }
}

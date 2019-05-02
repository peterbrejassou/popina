<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190502092932 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE boisson (id INT AUTO_INCREMENT NOT NULL, carte_id INT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, quantite DOUBLE PRECISION NOT NULL, INDEX IDX_8B97C84DC9C7CEB6 (carte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carte (id INT AUTO_INCREMENT NOT NULL, restaurant_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_BAD4FFFDB1E7706E (restaurant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dessert (id INT AUTO_INCREMENT NOT NULL, carte_id INT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, INDEX IDX_79291B96C9C7CEB6 (carte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entree (id INT AUTO_INCREMENT NOT NULL, carte_id INT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, INDEX IDX_598377A6C9C7CEB6 (carte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, carte_id INT DEFAULT NULL, prix INT NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_7D053A93C9C7CEB6 (carte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, restaurant_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_14B78418B1E7706E (restaurant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plat (id INT AUTO_INCREMENT NOT NULL, carte_id INT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_2038A207C9C7CEB6 (carte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, code_postal VARCHAR(5) NOT NULL, ville VARCHAR(255) NOT NULL, telephone VARCHAR(10) NOT NULL, email VARCHAR(255) NOT NULL, site_web VARCHAR(255) NOT NULL, horaires VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE boisson ADD CONSTRAINT FK_8B97C84DC9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id)');
        $this->addSql('ALTER TABLE carte ADD CONSTRAINT FK_BAD4FFFDB1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('ALTER TABLE dessert ADD CONSTRAINT FK_79291B96C9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id)');
        $this->addSql('ALTER TABLE entree ADD CONSTRAINT FK_598377A6C9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id)');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93C9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('ALTER TABLE plat ADD CONSTRAINT FK_2038A207C9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE boisson DROP FOREIGN KEY FK_8B97C84DC9C7CEB6');
        $this->addSql('ALTER TABLE dessert DROP FOREIGN KEY FK_79291B96C9C7CEB6');
        $this->addSql('ALTER TABLE entree DROP FOREIGN KEY FK_598377A6C9C7CEB6');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A93C9C7CEB6');
        $this->addSql('ALTER TABLE plat DROP FOREIGN KEY FK_2038A207C9C7CEB6');
        $this->addSql('ALTER TABLE carte DROP FOREIGN KEY FK_BAD4FFFDB1E7706E');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418B1E7706E');
        $this->addSql('DROP TABLE boisson');
        $this->addSql('DROP TABLE carte');
        $this->addSql('DROP TABLE dessert');
        $this->addSql('DROP TABLE entree');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE plat');
        $this->addSql('DROP TABLE restaurant');
    }
}

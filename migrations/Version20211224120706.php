<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211224120706 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, hotel_id INT NOT NULL, content VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, INDEX IDX_5F9E962AA76ED395 (user_id), INDEX IDX_5F9E962A3243BB18 (hotel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE destination (id INT AUTO_INCREMENT NOT NULL, nom_des VARCHAR(255) NOT NULL, infor_des LONGTEXT DEFAULT NULL, population INT DEFAULT NULL, sites_touristiques VARCHAR(255) DEFAULT NULL, transport VARCHAR(255) DEFAULT NULL, meteo VARCHAR(255) DEFAULT NULL, heure_locale VARCHAR(255) DEFAULT NULL, site_web VARCHAR(255) DEFAULT NULL, superficie VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(36) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, dat_event DATETIME NOT NULL, cancel TINYINT(1) NOT NULL, address VARCHAR(255) NOT NULL, phone INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hotel (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, stars_number INT NOT NULL, description TEXT NOT NULL, localisation VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, adresse VARCHAR(255) NOT NULL, available_rooms INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(36) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, date_begin DATETIME NOT NULL, date_end DATETIME NOT NULL, cancel TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, subject VARCHAR(50) NOT NULL, message VARCHAR(255) NOT NULL, stars_number INT NOT NULL, INDEX IDX_CE606404A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, reservation INT NOT NULL, user_id INT NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, number_of_nights INT NOT NULL, number_ofrooms INT NOT NULL, number_of_adults INT NOT NULL, number_of_childs INT NOT NULL, room_type VARCHAR(255) NOT NULL, total DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_42C8495542C84955 (reservation), INDEX IDX_42C84955A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation_restaurant (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, nombreplace INT NOT NULL, reservationdate DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation_transport (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, datereservation DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, localisation VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE temporal_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, email VARCHAR(50) NOT NULL, code_generated VARCHAR(6) DEFAULT NULL, UNIQUE INDEX UNIQ_810D1488F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transport (id INT AUTO_INCREMENT NOT NULL, localisation VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, prix VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE urgence (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, localisation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, username VARCHAR(180) NOT NULL, code_generated VARCHAR(6) DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D64968D05E93 (code_generated), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage_virtuelle (id INT AUTO_INCREMENT NOT NULL, nom_ville VARCHAR(255) NOT NULL, lien_video LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A3243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE606404A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495542C84955 FOREIGN KEY (reservation) REFERENCES hotel (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A3243BB18');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495542C84955');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AA76ED395');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE606404A76ED395');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A76ED395');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE destination');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE hotel');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE reservation_restaurant');
        $this->addSql('DROP TABLE reservation_transport');
        $this->addSql('DROP TABLE restaurant');
        $this->addSql('DROP TABLE temporal_user');
        $this->addSql('DROP TABLE transport');
        $this->addSql('DROP TABLE urgence');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE voyage_virtuelle');
    }
}

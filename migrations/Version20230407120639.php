<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230407120639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attendance (id INT AUTO_INCREMENT NOT NULL, training_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, userlastname VARCHAR(255) NOT NULL, useremail VARCHAR(255) NOT NULL, position VARCHAR(255) DEFAULT NULL, date LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', attendancy LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', note DOUBLE PRECISION DEFAULT NULL, INDEX IDX_6DE30D91BEFD98D1 (training_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE available (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, persona_id INT DEFAULT NULL, date_add DATE DEFAULT NULL, INDEX IDX_A58FA485A76ED395 (user_id), INDEX IDX_A58FA485F5F88DB9 (persona_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, subject VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE events (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, date_start DATE NOT NULL, date_end DATE NOT NULL, local VARCHAR(255) DEFAULT NULL, category VARCHAR(255) NOT NULL, cover VARCHAR(255) DEFAULT NULL, linkedin VARCHAR(255) DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, status TINYINT(1) DEFAULT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE expert (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, company VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, biography LONGTEXT DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, linkedin VARCHAR(255) DEFAULT NULL, twitter VARCHAR(255) DEFAULT NULL, date_add DATE DEFAULT NULL, status TINYINT(1) DEFAULT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_4F1B9342A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscreption (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, training_id INT DEFAULT NULL, status TINYINT(1) DEFAULT NULL, date_add DATE DEFAULT NULL, INDEX IDX_295236ADA76ED395 (user_id), INDEX IDX_295236ADBEFD98D1 (training_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE investor (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, logo VARCHAR(255) DEFAULT NULL, country VARCHAR(255) NOT NULL, field VARCHAR(255) NOT NULL, status TINYINT(1) NOT NULL, date_add DATE NOT NULL, linkedin VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, category VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mentor (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, cover VARCHAR(255) DEFAULT NULL, localisation VARCHAR(255) DEFAULT NULL, skills LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', occupation VARCHAR(255) DEFAULT NULL, status TINYINT(1) DEFAULT NULL, date_add DATE DEFAULT NULL, speciality VARCHAR(255) NOT NULL, programs LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', linkedin VARCHAR(255) DEFAULT NULL, mail VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_801562DEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, date_add DATE NOT NULL, author VARCHAR(255) NOT NULL, status TINYINT(1) NOT NULL, slug VARCHAR(255) NOT NULL, cover VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, venture_id INT DEFAULT NULL, fullname VARCHAR(255) NOT NULL, short_description VARCHAR(255) NOT NULL, position VARCHAR(255) NOT NULL, picture VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, linkedin VARCHAR(255) DEFAULT NULL, age INT DEFAULT NULL, INDEX IDX_C4E0A61F9E6A2B3D (venture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training (id INT AUTO_INCREMENT NOT NULL, trainer_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, type VARCHAR(255) NOT NULL, category VARCHAR(255) DEFAULT NULL, date_start DATE NOT NULL, date_end DATE NOT NULL, session INT DEFAULT NULL, status TINYINT(1) NOT NULL, link VARCHAR(255) DEFAULT NULL, course VARCHAR(255) DEFAULT NULL, cover VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_D5128A8FFB08EDF6 (trainer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, programme VARCHAR(255) NOT NULL, company VARCHAR(255) DEFAULT NULL, linkedin VARCHAR(255) DEFAULT NULL, twitter VARCHAR(255) DEFAULT NULL, biography LONGTEXT DEFAULT NULL, status TINYINT(1) DEFAULT NULL, email VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ventures (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, years DATE NOT NULL, category VARCHAR(255) DEFAULT NULL, country VARCHAR(255) NOT NULL, sector VARCHAR(255) NOT NULL, cover VARCHAR(255) DEFAULT NULL, flag VARCHAR(255) DEFAULT NULL, status TINYINT(1) NOT NULL, linked_in VARCHAR(255) DEFAULT NULL, mail VARCHAR(255) DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, website VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_322D5FEDA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attendance ADD CONSTRAINT FK_6DE30D91BEFD98D1 FOREIGN KEY (training_id) REFERENCES training (id)');
        $this->addSql('ALTER TABLE available ADD CONSTRAINT FK_A58FA485A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE available ADD CONSTRAINT FK_A58FA485F5F88DB9 FOREIGN KEY (persona_id) REFERENCES ventures (id)');
        $this->addSql('ALTER TABLE expert ADD CONSTRAINT FK_4F1B9342A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE inscreption ADD CONSTRAINT FK_295236ADA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE inscreption ADD CONSTRAINT FK_295236ADBEFD98D1 FOREIGN KEY (training_id) REFERENCES training (id)');
        $this->addSql('ALTER TABLE mentor ADD CONSTRAINT FK_801562DEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F9E6A2B3D FOREIGN KEY (venture_id) REFERENCES ventures (id)');
        $this->addSql('ALTER TABLE training ADD CONSTRAINT FK_D5128A8FFB08EDF6 FOREIGN KEY (trainer_id) REFERENCES expert (id)');
        $this->addSql('ALTER TABLE ventures ADD CONSTRAINT FK_322D5FEDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attendance DROP FOREIGN KEY FK_6DE30D91BEFD98D1');
        $this->addSql('ALTER TABLE available DROP FOREIGN KEY FK_A58FA485A76ED395');
        $this->addSql('ALTER TABLE available DROP FOREIGN KEY FK_A58FA485F5F88DB9');
        $this->addSql('ALTER TABLE expert DROP FOREIGN KEY FK_4F1B9342A76ED395');
        $this->addSql('ALTER TABLE inscreption DROP FOREIGN KEY FK_295236ADA76ED395');
        $this->addSql('ALTER TABLE inscreption DROP FOREIGN KEY FK_295236ADBEFD98D1');
        $this->addSql('ALTER TABLE mentor DROP FOREIGN KEY FK_801562DEA76ED395');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F9E6A2B3D');
        $this->addSql('ALTER TABLE training DROP FOREIGN KEY FK_D5128A8FFB08EDF6');
        $this->addSql('ALTER TABLE ventures DROP FOREIGN KEY FK_322D5FEDA76ED395');
        $this->addSql('DROP TABLE attendance');
        $this->addSql('DROP TABLE available');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE events');
        $this->addSql('DROP TABLE expert');
        $this->addSql('DROP TABLE inscreption');
        $this->addSql('DROP TABLE investor');
        $this->addSql('DROP TABLE mentor');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE training');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE ventures');
    }
}

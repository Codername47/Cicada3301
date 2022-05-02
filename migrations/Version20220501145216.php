<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220501145216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE achieved_flag (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, level_flag_id INT NOT NULL, date_achieve DATETIME NOT NULL, total_time VARCHAR(255) NOT NULL COMMENT \'(DC2Type:dateinterval)\', INDEX IDX_38EBBD08A76ED395 (user_id), INDEX IDX_38EBBD083037C1FA (level_flag_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE achieved_level (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, level_id INT NOT NULL, date_achive VARCHAR(255) NOT NULL COMMENT \'(DC2Type:dateinterval)\', date_achieve DATETIME NOT NULL, INDEX IDX_8402212DA76ED395 (user_id), INDEX IDX_8402212D5FB14BA7 (level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content (id INT AUTO_INCREMENT NOT NULL, level_flag_info_id INT NOT NULL, content_type_id INT NOT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_FEC530A9B999A998 (level_flag_info_id), INDEX IDX_FEC530A91A445520 (content_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(5) NOT NULL, icon VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE js_content (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level_flag (id INT AUTO_INCREMENT NOT NULL, level_id INT NOT NULL, name VARCHAR(255) NOT NULL, achieve_image VARCHAR(255) DEFAULT NULL, INDEX IDX_B8D1108B5FB14BA7 (level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level_flag_info (id INT AUTO_INCREMENT NOT NULL, js_content_id INT NOT NULL, UNIQUE INDEX UNIQ_A0D4ECE7E4604B87 (js_content_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, user_info_id_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(32) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649D27A9D4E (user_info_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_info (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, last_online DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE achieved_flag ADD CONSTRAINT FK_38EBBD08A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE achieved_flag ADD CONSTRAINT FK_38EBBD083037C1FA FOREIGN KEY (level_flag_id) REFERENCES level_flag (id)');
        $this->addSql('ALTER TABLE achieved_level ADD CONSTRAINT FK_8402212DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE achieved_level ADD CONSTRAINT FK_8402212D5FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A9B999A998 FOREIGN KEY (level_flag_info_id) REFERENCES level_flag_info (id)');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A91A445520 FOREIGN KEY (content_type_id) REFERENCES content_type (id)');
        $this->addSql('ALTER TABLE level_flag ADD CONSTRAINT FK_B8D1108B5FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE level_flag_info ADD CONSTRAINT FK_A0D4ECE7E4604B87 FOREIGN KEY (js_content_id) REFERENCES js_content (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D27A9D4E FOREIGN KEY (user_info_id_id) REFERENCES user_info (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A91A445520');
        $this->addSql('ALTER TABLE level_flag_info DROP FOREIGN KEY FK_A0D4ECE7E4604B87');
        $this->addSql('ALTER TABLE achieved_level DROP FOREIGN KEY FK_8402212D5FB14BA7');
        $this->addSql('ALTER TABLE level_flag DROP FOREIGN KEY FK_B8D1108B5FB14BA7');
        $this->addSql('ALTER TABLE achieved_flag DROP FOREIGN KEY FK_38EBBD083037C1FA');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A9B999A998');
        $this->addSql('ALTER TABLE achieved_flag DROP FOREIGN KEY FK_38EBBD08A76ED395');
        $this->addSql('ALTER TABLE achieved_level DROP FOREIGN KEY FK_8402212DA76ED395');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D27A9D4E');
        $this->addSql('DROP TABLE achieved_flag');
        $this->addSql('DROP TABLE achieved_level');
        $this->addSql('DROP TABLE content');
        $this->addSql('DROP TABLE content_type');
        $this->addSql('DROP TABLE js_content');
        $this->addSql('DROP TABLE level');
        $this->addSql('DROP TABLE level_flag');
        $this->addSql('DROP TABLE level_flag_info');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_info');
        $this->addSql('DROP TABLE messenger_messages');
    }
}

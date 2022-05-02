<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220501145806 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE achieved_level CHANGE date_achive total_time VARCHAR(255) NOT NULL COMMENT \'(DC2Type:dateinterval)\'');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D27A9D4E');
        $this->addSql('DROP INDEX UNIQ_8D93D649D27A9D4E ON user');
        $this->addSql('ALTER TABLE user CHANGE user_info_id_id user_info_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649586DFF2 FOREIGN KEY (user_info_id) REFERENCES user_info (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649586DFF2 ON user (user_info_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE achieved_level CHANGE total_time date_achive VARCHAR(255) NOT NULL COMMENT \'(DC2Type:dateinterval)\'');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649586DFF2');
        $this->addSql('DROP INDEX UNIQ_8D93D649586DFF2 ON user');
        $this->addSql('ALTER TABLE user CHANGE user_info_id user_info_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D27A9D4E FOREIGN KEY (user_info_id_id) REFERENCES user_info (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649D27A9D4E ON user (user_info_id_id)');
    }
}

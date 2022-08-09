<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220507231333 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE achieved_flag CHANGE date_achieve date_achieve DATETIME on update CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE achieved_level CHANGE date_achieve date_achieve DATETIME on update CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE level_flag DROP FOREIGN KEY FK_B8D1108B5311CE47');
        $this->addSql('DROP INDEX UNIQ_B8D1108B5311CE47 ON level_flag');
        $this->addSql('ALTER TABLE level_flag DROP next_flag_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE achieved_flag CHANGE date_achieve date_achieve DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE achieved_level CHANGE date_achieve date_achieve DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE level_flag ADD next_flag_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE level_flag ADD CONSTRAINT FK_B8D1108B5311CE47 FOREIGN KEY (next_flag_id) REFERENCES level_flag (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B8D1108B5311CE47 ON level_flag (next_flag_id)');
    }
}

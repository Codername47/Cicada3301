<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220501153601 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE level_flag ADD level_flag_info_id INT NOT NULL');
        $this->addSql('ALTER TABLE level_flag ADD CONSTRAINT FK_B8D1108BB999A998 FOREIGN KEY (level_flag_info_id) REFERENCES level_flag_info (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B8D1108BB999A998 ON level_flag (level_flag_info_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE level_flag DROP FOREIGN KEY FK_B8D1108BB999A998');
        $this->addSql('DROP INDEX UNIQ_B8D1108BB999A998 ON level_flag');
        $this->addSql('ALTER TABLE level_flag DROP level_flag_info_id');
    }
}

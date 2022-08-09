<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220509175613 extends AbstractMigration
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
        $this->addSql('ALTER TABLE level_flag DROP FOREIGN KEY FK_B8D1108BE4604B87');
        $this->addSql('ALTER TABLE level_flag ADD CONSTRAINT FK_B8D1108BE4604B87 FOREIGN KEY (js_content_id) REFERENCES js_content (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE achieved_flag CHANGE date_achieve date_achieve DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE achieved_level CHANGE date_achieve date_achieve DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE level_flag DROP FOREIGN KEY FK_B8D1108BE4604B87');
        $this->addSql('ALTER TABLE level_flag ADD CONSTRAINT FK_B8D1108BE4604B87 FOREIGN KEY (js_content_id) REFERENCES js_content (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}

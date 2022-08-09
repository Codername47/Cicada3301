<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220509174406 extends AbstractMigration
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
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE achieved_flag CHANGE date_achieve date_achieve DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE achieved_level CHANGE date_achieve date_achieve DATETIME DEFAULT NULL');
    }
}

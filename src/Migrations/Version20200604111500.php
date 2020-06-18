<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200604111500 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A3319A53AAD2 FOREIGN KEY (writing_language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331238D92B3 FOREIGN KEY (display_language_id) REFERENCES language (id)');
        $this->addSql('CREATE INDEX IDX_CBE5A3319A53AAD2 ON book (writing_language_id)');
        $this->addSql('CREATE INDEX IDX_CBE5A331238D92B3 ON book (display_language_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331238D92B3');
        $this->addSql('DROP INDEX IDX_CBE5A3319A53AAD2 ON book');
        $this->addSql('DROP INDEX IDX_CBE5A331238D92B3 ON book');
        $this->addSql('ALTER TABLE book DROP writing_language_id, DROP display_language_id, DROP title_in_writing_language');
    }
}

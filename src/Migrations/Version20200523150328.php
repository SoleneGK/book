<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200523150328 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE author (id INT AUTO_INCREMENT NOT NULL, first_name LONGTEXT DEFAULT NULL, middle_name LONGTEXT DEFAULT NULL, last_name LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, rating_id INT DEFAULT NULL, title LONGTEXT NOT NULL, INDEX IDX_CBE5A331A32EFC6 (rating_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book_author (book_id INT NOT NULL, author_id INT NOT NULL, INDEX IDX_9478D34516A2B381 (book_id), INDEX IDX_9478D345F675F31B (author_id), PRIMARY KEY(book_id, author_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book_genre (book_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_8D92268116A2B381 (book_id), INDEX IDX_8D9226814296D31F (genre_id), PRIMARY KEY(book_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book_language (book_id INT NOT NULL, language_id INT NOT NULL, INDEX IDX_CD2467EC16A2B381 (book_id), INDEX IDX_CD2467EC82F1BAF4 (language_id), PRIMARY KEY(book_id, language_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, name LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, name LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating (id INT AUTO_INCREMENT NOT NULL, value INT NOT NULL, code LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reading (id INT AUTO_INCREMENT NOT NULL, book_id INT NOT NULL, language_id INT NOT NULL, start_date DATE NOT NULL, end_date DATE DEFAULT NULL, INDEX IDX_C11AFC4116A2B381 (book_id), INDEX IDX_C11AFC4182F1BAF4 (language_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331A32EFC6 FOREIGN KEY (rating_id) REFERENCES rating (id)');
        $this->addSql('ALTER TABLE book_author ADD CONSTRAINT FK_9478D34516A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_author ADD CONSTRAINT FK_9478D345F675F31B FOREIGN KEY (author_id) REFERENCES author (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_genre ADD CONSTRAINT FK_8D92268116A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_genre ADD CONSTRAINT FK_8D9226814296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_language ADD CONSTRAINT FK_CD2467EC16A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_language ADD CONSTRAINT FK_CD2467EC82F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reading ADD CONSTRAINT FK_C11AFC4116A2B381 FOREIGN KEY (book_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE reading ADD CONSTRAINT FK_C11AFC4182F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE book_author DROP FOREIGN KEY FK_9478D345F675F31B');
        $this->addSql('ALTER TABLE book_author DROP FOREIGN KEY FK_9478D34516A2B381');
        $this->addSql('ALTER TABLE book_genre DROP FOREIGN KEY FK_8D92268116A2B381');
        $this->addSql('ALTER TABLE book_language DROP FOREIGN KEY FK_CD2467EC16A2B381');
        $this->addSql('ALTER TABLE reading DROP FOREIGN KEY FK_C11AFC4116A2B381');
        $this->addSql('ALTER TABLE book_genre DROP FOREIGN KEY FK_8D9226814296D31F');
        $this->addSql('ALTER TABLE book_language DROP FOREIGN KEY FK_CD2467EC82F1BAF4');
        $this->addSql('ALTER TABLE reading DROP FOREIGN KEY FK_C11AFC4182F1BAF4');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331A32EFC6');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE book_author');
        $this->addSql('DROP TABLE book_genre');
        $this->addSql('DROP TABLE book_language');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE rating');
        $this->addSql('DROP TABLE reading');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200523150407 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("insert into rating(value, code) values (0, '2')");
		$this->addSql("insert into rating(value, code) values (1, '3-')");
		$this->addSql("insert into rating(value, code) values (2, '3')");
		$this->addSql("insert into rating(value, code) values (3, '3+')");
		$this->addSql("insert into rating(value, code) values (4, '4-')");
		$this->addSql("insert into rating(value, code) values (5, '4')");
		$this->addSql("insert into rating(value, code) values (6, '4+')");
		$this->addSql("insert into rating(value, code) values (7, '5')");
    }

    public function down(Schema $schema) : void
    {

    }
}

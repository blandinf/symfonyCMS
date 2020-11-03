<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201103151634 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE offer_category (offer_id INTEGER NOT NULL, category_id INTEGER NOT NULL, PRIMARY KEY(offer_id, category_id))');
        $this->addSql('CREATE INDEX IDX_7F31A9A353C674EE ON offer_category (offer_id)');
        $this->addSql('CREATE INDEX IDX_7F31A9A312469DE2 ON offer_category (category_id)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, is_admin BOOLEAN NOT NULL, password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__offer AS SELECT id, title, description, price, date FROM offer');
        $this->addSql('DROP TABLE offer');
        $this->addSql('CREATE TABLE offer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, description CLOB NOT NULL COLLATE BINARY, price DOUBLE PRECISION NOT NULL, date DATETIME NOT NULL, image_name VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_29D6873EF675F31B FOREIGN KEY (author_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO offer (id, title, description, price, date) SELECT id, title, description, price, date FROM __temp__offer');
        $this->addSql('DROP TABLE __temp__offer');
        $this->addSql('CREATE INDEX IDX_29D6873EF675F31B ON offer (author_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE offer_category');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_29D6873EF675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__offer AS SELECT id, title, description, price, date FROM offer');
        $this->addSql('DROP TABLE offer');
        $this->addSql('CREATE TABLE offer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description CLOB NOT NULL, price DOUBLE PRECISION NOT NULL, date DATETIME NOT NULL)');
        $this->addSql('INSERT INTO offer (id, title, description, price, date) SELECT id, title, description, price, date FROM __temp__offer');
        $this->addSql('DROP TABLE __temp__offer');
    }
}

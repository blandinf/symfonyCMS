<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201104125732 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL)');
        $this->addSql('DROP INDEX IDX_29D6873EF675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__offer AS SELECT id, author_id, title, description, price, date FROM offer');
        $this->addSql('DROP TABLE offer');
        $this->addSql('CREATE TABLE offer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER DEFAULT NULL, image_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, description CLOB NOT NULL COLLATE BINARY, price DOUBLE PRECISION NOT NULL, date DATETIME NOT NULL, CONSTRAINT FK_29D6873E3DA5256D FOREIGN KEY (image_id) REFERENCES image (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_29D6873EF675F31B FOREIGN KEY (author_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO offer (id, author_id, title, description, price, date) SELECT id, author_id, title, description, price, date FROM __temp__offer');
        $this->addSql('DROP TABLE __temp__offer');
        $this->addSql('CREATE INDEX IDX_29D6873EF675F31B ON offer (author_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_29D6873E3DA5256D ON offer (image_id)');
        $this->addSql('DROP INDEX IDX_7F31A9A353C674EE');
        $this->addSql('DROP INDEX IDX_7F31A9A312469DE2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__offer_category AS SELECT offer_id, category_id FROM offer_category');
        $this->addSql('DROP TABLE offer_category');
        $this->addSql('CREATE TABLE offer_category (offer_id INTEGER NOT NULL, category_id INTEGER NOT NULL, PRIMARY KEY(offer_id, category_id), CONSTRAINT FK_7F31A9A353C674EE FOREIGN KEY (offer_id) REFERENCES offer (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_7F31A9A312469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO offer_category (offer_id, category_id) SELECT offer_id, category_id FROM __temp__offer_category');
        $this->addSql('DROP TABLE __temp__offer_category');
        $this->addSql('CREATE INDEX IDX_7F31A9A353C674EE ON offer_category (offer_id)');
        $this->addSql('CREATE INDEX IDX_7F31A9A312469DE2 ON offer_category (category_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, phone, password FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, password VARCHAR(255) NOT NULL COLLATE BINARY, email VARCHAR(180) NOT NULL, phone VARCHAR(10) NOT NULL, name VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        )');
        $this->addSql('INSERT INTO user (id, email, phone, password) SELECT id, email, phone, password FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6495E237E06 ON user (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649444F97DD ON user (phone)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP INDEX UNIQ_29D6873E3DA5256D');
        $this->addSql('DROP INDEX IDX_29D6873EF675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__offer AS SELECT id, author_id, title, description, price, date FROM offer');
        $this->addSql('DROP TABLE offer');
        $this->addSql('CREATE TABLE offer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description CLOB NOT NULL, price DOUBLE PRECISION NOT NULL, date DATETIME NOT NULL, author_id INTEGER NOT NULL, image_name VARCHAR(255) DEFAULT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO offer (id, author_id, title, description, price, date) SELECT id, author_id, title, description, price, date FROM __temp__offer');
        $this->addSql('DROP TABLE __temp__offer');
        $this->addSql('CREATE INDEX IDX_29D6873EF675F31B ON offer (author_id)');
        $this->addSql('DROP INDEX IDX_7F31A9A353C674EE');
        $this->addSql('DROP INDEX IDX_7F31A9A312469DE2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__offer_category AS SELECT offer_id, category_id FROM offer_category');
        $this->addSql('DROP TABLE offer_category');
        $this->addSql('CREATE TABLE offer_category (offer_id INTEGER NOT NULL, category_id INTEGER NOT NULL, PRIMARY KEY(offer_id, category_id))');
        $this->addSql('INSERT INTO offer_category (offer_id, category_id) SELECT offer_id, category_id FROM __temp__offer_category');
        $this->addSql('DROP TABLE __temp__offer_category');
        $this->addSql('CREATE INDEX IDX_7F31A9A353C674EE ON offer_category (offer_id)');
        $this->addSql('CREATE INDEX IDX_7F31A9A312469DE2 ON offer_category (category_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D6495E237E06');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74');
        $this->addSql('DROP INDEX UNIQ_8D93D649444F97DD');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, phone, password FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL COLLATE BINARY, phone VARCHAR(255) NOT NULL COLLATE BINARY, username VARCHAR(255) NOT NULL COLLATE BINARY, is_admin BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO user (id, email, phone, password) SELECT id, email, phone, password FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
    }
}

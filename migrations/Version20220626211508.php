<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220626211508 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_D4E6F81A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__address AS SELECT id, user_id, full_name, company, address, complement, phone, city, code_postal, country FROM address');
        $this->addSql('DROP TABLE address');
        $this->addSql('CREATE TABLE address (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, full_name VARCHAR(255) NOT NULL, company VARCHAR(255) DEFAULT NULL, address CLOB NOT NULL, complement CLOB DEFAULT NULL, phone INTEGER NOT NULL, city VARCHAR(255) NOT NULL, code_postal INTEGER NOT NULL, country VARCHAR(255) NOT NULL, CONSTRAINT FK_D4E6F81A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO address (id, user_id, full_name, company, address, complement, phone, city, code_postal, country) SELECT id, user_id, full_name, company, address, complement, phone, city, code_postal, country FROM __temp__address');
        $this->addSql('DROP TABLE __temp__address');
        $this->addSql('CREATE INDEX IDX_D4E6F81A76ED395 ON address (user_id)');
        $this->addSql('DROP INDEX IDX_A9941943A21214B7');
        $this->addSql('DROP INDEX IDX_A99419434584665A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product_categories AS SELECT product_id, categories_id FROM product_categories');
        $this->addSql('DROP TABLE product_categories');
        $this->addSql('CREATE TABLE product_categories (product_id INTEGER NOT NULL, categories_id INTEGER NOT NULL, PRIMARY KEY(product_id, categories_id), CONSTRAINT FK_A99419434584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_A9941943A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO product_categories (product_id, categories_id) SELECT product_id, categories_id FROM __temp__product_categories');
        $this->addSql('DROP TABLE __temp__product_categories');
        $this->addSql('CREATE INDEX IDX_A9941943A21214B7 ON product_categories (categories_id)');
        $this->addSql('CREATE INDEX IDX_A99419434584665A ON product_categories (product_id)');
        $this->addSql('DROP INDEX IDX_EC53CE084584665A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__related_product AS SELECT id, product_id FROM related_product');
        $this->addSql('DROP TABLE related_product');
        $this->addSql('CREATE TABLE related_product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, product_id INTEGER NOT NULL, CONSTRAINT FK_EC53CE084584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO related_product (id, product_id) SELECT id, product_id FROM __temp__related_product');
        $this->addSql('DROP TABLE __temp__related_product');
        $this->addSql('CREATE INDEX IDX_EC53CE084584665A ON related_product (product_id)');
        $this->addSql('DROP INDEX IDX_7CE748AA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__reset_password_request AS SELECT id, user_id, selector, hashed_token, requested_at, expires_at FROM reset_password_request');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('CREATE TABLE reset_password_request (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , expires_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO reset_password_request (id, user_id, selector, hashed_token, requested_at, expires_at) SELECT id, user_id, selector, hashed_token, requested_at, expires_at FROM __temp__reset_password_request');
        $this->addSql('DROP TABLE __temp__reset_password_request');
        $this->addSql('CREATE INDEX IDX_7CE748AA76ED395 ON reset_password_request (user_id)');
        $this->addSql('DROP INDEX IDX_E0851D6C4584665A');
        $this->addSql('DROP INDEX IDX_E0851D6CA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__reviews_product AS SELECT id, user_id, product_id, note, comment FROM reviews_product');
        $this->addSql('DROP TABLE reviews_product');
        $this->addSql('CREATE TABLE reviews_product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, product_id INTEGER NOT NULL, note INTEGER NOT NULL, comment CLOB DEFAULT NULL, CONSTRAINT FK_E0851D6CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E0851D6C4584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO reviews_product (id, user_id, product_id, note, comment) SELECT id, user_id, product_id, note, comment FROM __temp__reviews_product');
        $this->addSql('DROP TABLE __temp__reviews_product');
        $this->addSql('CREATE INDEX IDX_E0851D6C4584665A ON reviews_product (product_id)');
        $this->addSql('CREATE INDEX IDX_E0851D6CA76ED395 ON reviews_product (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_D4E6F81A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__address AS SELECT id, user_id, full_name, company, address, complement, phone, city, code_postal, country FROM address');
        $this->addSql('DROP TABLE address');
        $this->addSql('CREATE TABLE address (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, full_name VARCHAR(255) NOT NULL, company VARCHAR(255) DEFAULT NULL, address CLOB NOT NULL, complement CLOB DEFAULT NULL, phone INTEGER NOT NULL, city VARCHAR(255) NOT NULL, code_postal INTEGER NOT NULL, country VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO address (id, user_id, full_name, company, address, complement, phone, city, code_postal, country) SELECT id, user_id, full_name, company, address, complement, phone, city, code_postal, country FROM __temp__address');
        $this->addSql('DROP TABLE __temp__address');
        $this->addSql('CREATE INDEX IDX_D4E6F81A76ED395 ON address (user_id)');
        $this->addSql('DROP INDEX IDX_A99419434584665A');
        $this->addSql('DROP INDEX IDX_A9941943A21214B7');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product_categories AS SELECT product_id, categories_id FROM product_categories');
        $this->addSql('DROP TABLE product_categories');
        $this->addSql('CREATE TABLE product_categories (product_id INTEGER NOT NULL, categories_id INTEGER NOT NULL, PRIMARY KEY(product_id, categories_id))');
        $this->addSql('INSERT INTO product_categories (product_id, categories_id) SELECT product_id, categories_id FROM __temp__product_categories');
        $this->addSql('DROP TABLE __temp__product_categories');
        $this->addSql('CREATE INDEX IDX_A99419434584665A ON product_categories (product_id)');
        $this->addSql('CREATE INDEX IDX_A9941943A21214B7 ON product_categories (categories_id)');
        $this->addSql('DROP INDEX IDX_EC53CE084584665A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__related_product AS SELECT id, product_id FROM related_product');
        $this->addSql('DROP TABLE related_product');
        $this->addSql('CREATE TABLE related_product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, product_id INTEGER NOT NULL)');
        $this->addSql('INSERT INTO related_product (id, product_id) SELECT id, product_id FROM __temp__related_product');
        $this->addSql('DROP TABLE __temp__related_product');
        $this->addSql('CREATE INDEX IDX_EC53CE084584665A ON related_product (product_id)');
        $this->addSql('DROP INDEX IDX_7CE748AA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__reset_password_request AS SELECT id, user_id, selector, hashed_token, requested_at, expires_at FROM reset_password_request');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('CREATE TABLE reset_password_request (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , expires_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO reset_password_request (id, user_id, selector, hashed_token, requested_at, expires_at) SELECT id, user_id, selector, hashed_token, requested_at, expires_at FROM __temp__reset_password_request');
        $this->addSql('DROP TABLE __temp__reset_password_request');
        $this->addSql('CREATE INDEX IDX_7CE748AA76ED395 ON reset_password_request (user_id)');
        $this->addSql('DROP INDEX IDX_E0851D6CA76ED395');
        $this->addSql('DROP INDEX IDX_E0851D6C4584665A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__reviews_product AS SELECT id, user_id, product_id, note, comment FROM reviews_product');
        $this->addSql('DROP TABLE reviews_product');
        $this->addSql('CREATE TABLE reviews_product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, product_id INTEGER NOT NULL, note INTEGER NOT NULL, comment CLOB DEFAULT NULL)');
        $this->addSql('INSERT INTO reviews_product (id, user_id, product_id, note, comment) SELECT id, user_id, product_id, note, comment FROM __temp__reviews_product');
        $this->addSql('DROP TABLE __temp__reviews_product');
        $this->addSql('CREATE INDEX IDX_E0851D6CA76ED395 ON reviews_product (user_id)');
        $this->addSql('CREATE INDEX IDX_E0851D6C4584665A ON reviews_product (product_id)');
    }
}

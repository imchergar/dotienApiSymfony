<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250324225500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact_list (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_6C377AE77E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_list_user (contact_list_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_A6AC2ADBA781370A (contact_list_id), INDEX IDX_A6AC2ADBA76ED395 (user_id), PRIMARY KEY(contact_list_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), UNIQUE INDEX UNIQ_IDENTIFIER_PHONE_NUMBER (phone_number), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact_list ADD CONSTRAINT FK_6C377AE77E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE contact_list_user ADD CONSTRAINT FK_A6AC2ADBA781370A FOREIGN KEY (contact_list_id) REFERENCES contact_list (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact_list_user ADD CONSTRAINT FK_A6AC2ADBA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact_list DROP FOREIGN KEY FK_6C377AE77E3C61F9');
        $this->addSql('ALTER TABLE contact_list_user DROP FOREIGN KEY FK_A6AC2ADBA781370A');
        $this->addSql('ALTER TABLE contact_list_user DROP FOREIGN KEY FK_A6AC2ADBA76ED395');
        $this->addSql('DROP TABLE contact_list');
        $this->addSql('DROP TABLE contact_list_user');
        $this->addSql('DROP TABLE `user`');
    }
}

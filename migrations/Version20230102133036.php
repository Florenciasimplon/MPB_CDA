<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230102133036 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE belly (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, picture VARCHAR(1600) DEFAULT NULL, month VARCHAR(2) NOT NULL, date DATETIME NOT NULL, text_picture VARCHAR(255) DEFAULT NULL, INDEX IDX_88740B76A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE belly ADD CONSTRAINT FK_88740B76A76ED395 FOREIGN KEY (user_id) REFERENCES user_authentication (id)');
        $this->addSql('ALTER TABLE article CHANGE text text VARCHAR(2000) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE belly DROP FOREIGN KEY FK_88740B76A76ED395');
        $this->addSql('DROP TABLE belly');
        $this->addSql('ALTER TABLE article CHANGE text text VARCHAR(15000) NOT NULL');
    }
}

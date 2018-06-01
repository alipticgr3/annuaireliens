<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180526210621 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE links (id INT AUTO_INCREMENT NOT NULL, idcategory_id INT NOT NULL, iduser_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, tagline VARCHAR(255) NOT NULL, detail LONGTEXT DEFAULT NULL, url LONGTEXT NOT NULL, datecreate DATETIME NOT NULL, dateupdate DATETIME NOT NULL, INDEX IDX_D182A118D487ED4D (idcategory_id), INDEX IDX_D182A118786A81FB (iduser_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, logo VARCHAR(30) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE links ADD CONSTRAINT FK_D182A118D487ED4D FOREIGN KEY (idcategory_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE links ADD CONSTRAINT FK_D182A118786A81FB FOREIGN KEY (iduser_id) REFERENCES users (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE links DROP FOREIGN KEY FK_D182A118D487ED4D');
        $this->addSql('DROP TABLE links');
        $this->addSql('DROP TABLE categories');
    }
}

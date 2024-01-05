<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240104081224 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE montres ADD description VARCHAR(255) NOT NULL, ADD image_montre VARCHAR(255) DEFAULT NULL, ADD quantite_montre INT NOT NULL');
        $this->addSql('ALTER TABLE telephones ADD description VARCHAR(255) NOT NULL, ADD image_tel VARCHAR(255) DEFAULT NULL, ADD quantite_livre INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD image_user VARCHAR(255) DEFAULT NULL, ADD nom_user VARCHAR(50) NOT NULL, ADD prenom_user VARCHAR(50) NOT NULL, ADD pseudo_user VARCHAR(50) NOT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD tel VARCHAR(12) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE montres DROP description, DROP image_montre, DROP quantite_montre');
        $this->addSql('ALTER TABLE telephones DROP description, DROP image_tel, DROP quantite_livre');
        $this->addSql('ALTER TABLE user DROP image_user, DROP nom_user, DROP prenom_user, DROP pseudo_user, DROP created_at, DROP tel');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200317145810 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hospital ADD postal VARCHAR(255) DEFAULT NULL, ADD ville VARCHAR(50) NOT NULL, ADD pays VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE chambre ADD hospital_id INT NOT NULL, ADD nom VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FF63DBB69 FOREIGN KEY (hospital_id) REFERENCES hospital (id)');
        $this->addSql('CREATE INDEX IDX_C509E4FF63DBB69 ON chambre (hospital_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FF63DBB69');
        $this->addSql('DROP INDEX IDX_C509E4FF63DBB69 ON chambre');
        $this->addSql('ALTER TABLE chambre DROP hospital_id, DROP nom');
        $this->addSql('ALTER TABLE hospital DROP postal, DROP ville, DROP pays');
    }
}

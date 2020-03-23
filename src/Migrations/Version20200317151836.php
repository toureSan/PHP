<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200317151836 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE admission ADD patient_id INT NOT NULL, ADD chambre_id INT NOT NULL, ADD date_debut DATETIME NOT NULL, ADD date_fin DATETIME NOT NULL');
        $this->addSql('ALTER TABLE admission ADD CONSTRAINT FK_F4BB024A6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE admission ADD CONSTRAINT FK_F4BB024A9B177F54 FOREIGN KEY (chambre_id) REFERENCES chambre (id)');
        $this->addSql('CREATE INDEX IDX_F4BB024A6B899279 ON admission (patient_id)');
        $this->addSql('CREATE INDEX IDX_F4BB024A9B177F54 ON admission (chambre_id)');
        $this->addSql('ALTER TABLE chambre ADD capacite INT DEFAULT NULL');
        $this->addSql('ALTER TABLE patient ADD nom VARCHAR(50) NOT NULL, ADD prenom VARCHAR(50) NOT NULL, ADD avs_num VARCHAR(100) NOT NULL, ADD birthdate DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE admission DROP FOREIGN KEY FK_F4BB024A6B899279');
        $this->addSql('ALTER TABLE admission DROP FOREIGN KEY FK_F4BB024A9B177F54');
        $this->addSql('DROP INDEX IDX_F4BB024A6B899279 ON admission');
        $this->addSql('DROP INDEX IDX_F4BB024A9B177F54 ON admission');
        $this->addSql('ALTER TABLE admission DROP patient_id, DROP chambre_id, DROP date_debut, DROP date_fin');
        $this->addSql('ALTER TABLE chambre DROP capacite');
        $this->addSql('ALTER TABLE patient DROP nom, DROP prenom, DROP avs_num, DROP birthdate');
    }
}

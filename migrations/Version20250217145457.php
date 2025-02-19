<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250217145457 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis ADD depose_par_id INT NOT NULL, ADD concerne_id INT NOT NULL');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0DCFF0FC4 FOREIGN KEY (depose_par_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF06406FEF1 FOREIGN KEY (concerne_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_8F91ABF0DCFF0FC4 ON avis (depose_par_id)');
        $this->addSql('CREATE INDEX IDX_8F91ABF06406FEF1 ON avis (concerne_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0DCFF0FC4');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF06406FEF1');
        $this->addSql('DROP INDEX IDX_8F91ABF0DCFF0FC4 ON avis');
        $this->addSql('DROP INDEX IDX_8F91ABF06406FEF1 ON avis');
        $this->addSql('ALTER TABLE avis DROP depose_par_id, DROP concerne_id');
    }
}

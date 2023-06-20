<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230619103239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cliente CHANGE apellido2 apellido2 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE pedido DROP FOREIGN KEY FK_C4EC16CEBF396750');
        $this->addSql('ALTER TABLE pedido ADD fk_cliente_id INT NOT NULL');
        $this->addSql('ALTER TABLE pedido ADD CONSTRAINT FK_C4EC16CE2E1D84C2 FOREIGN KEY (fk_cliente_id) REFERENCES cliente (id)');
        $this->addSql('CREATE INDEX IDX_C4EC16CE2E1D84C2 ON pedido (fk_cliente_id)');
        $this->addSql('ALTER TABLE producto DROP FOREIGN KEY FK_A7BB0615BF396750');
        $this->addSql('ALTER TABLE producto ADD fk_fabricante_id INT NOT NULL');
        $this->addSql('ALTER TABLE producto ADD CONSTRAINT FK_A7BB0615A4EA8838 FOREIGN KEY (fk_fabricante_id) REFERENCES fabricante (id)');
        $this->addSql('CREATE INDEX IDX_A7BB0615A4EA8838 ON producto (fk_fabricante_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cliente CHANGE apellido2 apellido2 VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE pedido DROP FOREIGN KEY FK_C4EC16CE2E1D84C2');
        $this->addSql('DROP INDEX IDX_C4EC16CE2E1D84C2 ON pedido');
        $this->addSql('ALTER TABLE pedido DROP fk_cliente_id');
        $this->addSql('ALTER TABLE pedido ADD CONSTRAINT FK_C4EC16CEBF396750 FOREIGN KEY (id) REFERENCES cliente (id)');
        $this->addSql('ALTER TABLE producto DROP FOREIGN KEY FK_A7BB0615A4EA8838');
        $this->addSql('DROP INDEX IDX_A7BB0615A4EA8838 ON producto');
        $this->addSql('ALTER TABLE producto DROP fk_fabricante_id');
        $this->addSql('ALTER TABLE producto ADD CONSTRAINT FK_A7BB0615BF396750 FOREIGN KEY (id) REFERENCES fabricante (id)');
    }
}

<?php
declare(strict_types = 1);

namespace Av\Common\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Создание таблицы клиник
 */
final class Version20191207205745CreateClinicTable extends AbstractMigration
{
    /**
     * @inheritDoc
     */
    public function getDescription(): string
    {
        return 'Создание таблицы клиник';
    }

    /**
     * @inheritDoc
     */
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE clinic_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE clinic (id INT NOT NULL, address VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, quarantine BOOLEAN NOT NULL, quarantine_date DATE DEFAULT NULL, contact_info VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
    }

    /**
     * @inheritDoc
     */
    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE clinic_id_seq CASCADE');
        $this->addSql('DROP TABLE clinic');
    }
}

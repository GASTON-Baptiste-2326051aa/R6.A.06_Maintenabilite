<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260213082118 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE championship (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, sport_id_id INT NOT NULL, UNIQUE INDEX UNIQ_EBADDE6ACB38FF4E (sport_id_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE competition (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, championship_id_id INT DEFAULT NULL, INDEX IDX_B50A2CB170606156 (championship_id_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE sport (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE trial (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE trial_competition (trial_id INT NOT NULL, competition_id INT NOT NULL, INDEX IDX_A720892D5596D5F7 (trial_id), INDEX IDX_A720892D7B39D312 (competition_id), PRIMARY KEY (trial_id, competition_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE trial_sport (trial_id INT NOT NULL, sport_id INT NOT NULL, INDEX IDX_5628D69E5596D5F7 (trial_id), INDEX IDX_5628D69EAC78BCF8 (sport_id), PRIMARY KEY (trial_id, sport_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE type_sport (type_id INT NOT NULL, sport_id INT NOT NULL, INDEX IDX_14896825C54C8C93 (type_id), INDEX IDX_14896825AC78BCF8 (sport_id), PRIMARY KEY (type_id, sport_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE championship ADD CONSTRAINT FK_EBADDE6ACB38FF4E FOREIGN KEY (sport_id_id) REFERENCES sport (id)');
        $this->addSql('ALTER TABLE competition ADD CONSTRAINT FK_B50A2CB170606156 FOREIGN KEY (championship_id_id) REFERENCES championship (id)');
        $this->addSql('ALTER TABLE trial_competition ADD CONSTRAINT FK_A720892D5596D5F7 FOREIGN KEY (trial_id) REFERENCES trial (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trial_competition ADD CONSTRAINT FK_A720892D7B39D312 FOREIGN KEY (competition_id) REFERENCES competition (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trial_sport ADD CONSTRAINT FK_5628D69E5596D5F7 FOREIGN KEY (trial_id) REFERENCES trial (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trial_sport ADD CONSTRAINT FK_5628D69EAC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_sport ADD CONSTRAINT FK_14896825C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_sport ADD CONSTRAINT FK_14896825AC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE championship DROP FOREIGN KEY FK_EBADDE6ACB38FF4E');
        $this->addSql('ALTER TABLE competition DROP FOREIGN KEY FK_B50A2CB170606156');
        $this->addSql('ALTER TABLE trial_competition DROP FOREIGN KEY FK_A720892D5596D5F7');
        $this->addSql('ALTER TABLE trial_competition DROP FOREIGN KEY FK_A720892D7B39D312');
        $this->addSql('ALTER TABLE trial_sport DROP FOREIGN KEY FK_5628D69E5596D5F7');
        $this->addSql('ALTER TABLE trial_sport DROP FOREIGN KEY FK_5628D69EAC78BCF8');
        $this->addSql('ALTER TABLE type_sport DROP FOREIGN KEY FK_14896825C54C8C93');
        $this->addSql('ALTER TABLE type_sport DROP FOREIGN KEY FK_14896825AC78BCF8');
        $this->addSql('DROP TABLE championship');
        $this->addSql('DROP TABLE competition');
        $this->addSql('DROP TABLE sport');
        $this->addSql('DROP TABLE trial');
        $this->addSql('DROP TABLE trial_competition');
        $this->addSql('DROP TABLE trial_sport');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE type_sport');
    }
}

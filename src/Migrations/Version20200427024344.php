<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200427024344 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pizza (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pizza_topping (pizza_id INT NOT NULL, topping_id INT NOT NULL, INDEX IDX_26454CADD41D1D42 (pizza_id), INDEX IDX_26454CADE9C2067C (topping_id), PRIMARY KEY(pizza_id, topping_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, customer VARCHAR(100) NOT NULL, phone VARCHAR(30) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_pizza (order_id INT NOT NULL, pizza_id INT NOT NULL, INDEX IDX_4C43F6928D9F6D38 (order_id), INDEX IDX_4C43F692D41D1D42 (pizza_id), PRIMARY KEY(order_id, pizza_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE topping (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pizza_topping ADD CONSTRAINT FK_26454CADD41D1D42 FOREIGN KEY (pizza_id) REFERENCES pizza (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pizza_topping ADD CONSTRAINT FK_26454CADE9C2067C FOREIGN KEY (topping_id) REFERENCES topping (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_pizza ADD CONSTRAINT FK_4C43F6928D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_pizza ADD CONSTRAINT FK_4C43F692D41D1D42 FOREIGN KEY (pizza_id) REFERENCES pizza (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pizza_topping DROP FOREIGN KEY FK_26454CADD41D1D42');
        $this->addSql('ALTER TABLE order_pizza DROP FOREIGN KEY FK_4C43F692D41D1D42');
        $this->addSql('ALTER TABLE order_pizza DROP FOREIGN KEY FK_4C43F6928D9F6D38');
        $this->addSql('ALTER TABLE pizza_topping DROP FOREIGN KEY FK_26454CADE9C2067C');
        $this->addSql('DROP TABLE pizza');
        $this->addSql('DROP TABLE pizza_topping');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_pizza');
        $this->addSql('DROP TABLE topping');
    }
}

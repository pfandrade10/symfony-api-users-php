
 -- The following SQL statements will be executed:

     CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, address_id INT DEFAULT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_8D93D649F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
     CREATE TABLE user_user_contact_phone (user_id INT NOT NULL, phonenumber_id INT NOT NULL, INDEX IDX_2BAFCC79A76ED395 (user_id), UNIQUE INDEX UNIQ_2BAFCC79D626887C (phonenumber_id), PRIMARY KEY(user_id, phonenumber_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
     CREATE TABLE user_address (id INT AUTO_INCREMENT NOT NULL, state VARCHAR(100) NOT NULL, city VARCHAR(100) NOT NULL, district VARCHAR(100) NOT NULL, street VARCHAR(100) NOT NULL, number VARCHAR(100) NOT NULL, complement VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
     CREATE TABLE user_contact_phone (id INT AUTO_INCREMENT NOT NULL, area_code INT NOT NULL, sufix VARCHAR(9) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
     ALTER TABLE user ADD CONSTRAINT FK_8D93D649F5B7AF75 FOREIGN KEY (address_id) REFERENCES user_address (id);
     ALTER TABLE user_user_contact_phone ADD CONSTRAINT FK_2BAFCC79A76ED395 FOREIGN KEY (user_id) REFERENCES user (id);
     ALTER TABLE user_user_contact_phone ADD CONSTRAINT FK_2BAFCC79D626887C FOREIGN KEY (phonenumber_id) REFERENCES user_contact_phone (id);

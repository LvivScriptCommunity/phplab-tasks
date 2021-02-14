CREATE DATABASE cars;

CREATE TABLE manufacturers
(
    id          INT(2) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name        VARCHAR(50) NOT NULL
);

INSERT INTO manufacturers (name)
VALUES ('Volkswagen Group'), ('BMW AG'), ('Opel Automobile GmbH'), ('General Motors');

CREATE TABLE makes
(
    id                            INT(2) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name                          VARCHAR(50) NOT NULL,
    manufacturer_id               INT(2) UNSIGNED NOT NULL,
    FOREIGN KEY (manufacturer_id) REFERENCES manufacturers(id)
);

INSERT INTO makes (name, manufacturer_id)
VALUES ('Audi', 1), ('Opel', 3), ('BMW', 2), ('Chevrolet', 4), ('Volkswagen', 1), ('Buick', 4), ('Porsche', 1), ('GMC', 4);

CREATE TABLE models
(
    id                    INT(2) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name                  VARCHAR(50) NOT NULL,
    make_id               INT(2) UNSIGNED NOT NULL,
    price                 INT(7) NOT NULL,
    FOREIGN KEY (make_id) REFERENCES makes(id)
);

INSERT INTO models (name, make_id, price)
VALUES ('A4',1, 45000), ('X5', 3, 68000), ('Panamera', 7, 125000), ('Tahoe', 4, 54000), ('Passat', 5, 34000),
       ('ENCLAVE', 6, 41000), ('Sierra', 8, 61000), ('X7', 3, 99000);
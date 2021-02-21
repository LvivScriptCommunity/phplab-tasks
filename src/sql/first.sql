CREATE DATABASE hospital;

CREATE TABLE diseases
(
    id          	INT UNSIGNED  AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nameDiseases    VARCHAR NOT NULL
);

INSERT INTO diseases (nameDiseases)
VALUES ('firstdiseases'), ('seconddiseases'), ('thirddiseases');

CREATE TABLE medicines
(
    id                      INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name                    VARCHAR(50) NOT NULL,
    amount			        INT, NOY NULL,
    diseasesId              INT UNSIGNED NOT NULL,
    FOREIGN KEY (diseasesId) REFERENCES diseases(id)
);

INSERT INTO medicines(name, amount, diseasesId)
VALUES ('firstMedicinesa', 50, 3), ('secondMedicinesa', 70, 2), ('thirdMedicinesa', 25, 1);

CREATE TABLE patients
(
    id                    INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    firstName             VARCHAR(50) NOT NULL,
    lastName              VARCHAR(50) NOT NULL,
    gender                CHAR NOT NULL,
    medicinesId           INT UNSIGNED NOT NULL,
    FOREIGN KEY (medicinesId) REFERENCES medicines(id)
);

INSERT INTO patients (firstName, lastName, gender, medicinesId)
VALUES ('Marian','Danyliv', 'mal' 1), ('Tanuya','Ivanisha', 'fem' 2), ('Volodia','Danyliv', 'mal' 3);
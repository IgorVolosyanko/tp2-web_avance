DROP DATABASE bibliotheque;
CREATE DATABASE bibliotheque;

CREATE TABLE auteur (
id INT NOT NULL AUTO_INCREMENT,
nom VARCHAR(45) NOT NULL,
CONSTRAINT pk_auteur PRIMARY KEY (id)
);

CREATE TABLE categorie (
id INT NOT NULL AUTO_INCREMENT,
nom VARCHAR(45) NOT NULL,
CONSTRAINT pk_categorie PRIMARY KEY (id)
);

CREATE TABLE editeur (
id INT NOT NULL AUTO_INCREMENT,
nom VARCHAR(45) NOT NULL,
CONSTRAINT pk_editeur PRIMARY KEY (id)
);

CREATE TABLE client (
id INT NOT NULL AUTO_INCREMENT,
nom VARCHAR(45) NOT NULL,
adresse VARCHAR(45) NOT NULL,
telephone VARCHAR(45) NOT NULL,
courriel VARCHAR(45) NOT NULL,
CONSTRAINT pk_client PRIMARY KEY (id)
);

CREATE TABLE livre (
id INT NOT NULL AUTO_INCREMENT,
titre VARCHAR(225) NOT NULL,
description TEXT,
pages VARCHAR(10),
image VARCHAR(225),
auteur_id INT NOT NULL,
editeur_id INT NOT NULL,
categorie_id INT NOT NULL,
CONSTRAINT pk_livre PRIMARY KEY (id),
CONSTRAINT fk_auteur_id FOREIGN KEY (auteur_id)
REFERENCES auteur(id),
CONSTRAINT fk_editeur_id FOREIGN KEY (editeur_id)
REFERENCES editeur(id),
CONSTRAINT fk_categorie_id FOREIGN KEY (categorie_id)
REFERENCES categorie(id)
);

CREATE TABLE pret (
id INT NOT NULL AUTO_INCREMENT,
date_debut DATE NOT NULL,
date_fin DATE NOT NULL,
client_id INT NOT NULL,
CONSTRAINT pk_pret PRIMARY KEY (id),
CONSTRAINT fk_client_id FOREIGN KEY (client_id)
REFERENCES client(id)
);

ALTER TABLE pret AUTO_INCREMENT = 100;

CREATE TABLE pret_has_livre(
livre_id INT NOT NULL,
pret_id INT NOT NULL,
CONSTRAINT pk_livre_facture PRIMARY KEY (livre_id, pret_id),
CONSTRAINT fk_livre_id FOREIGN KEY (livre_id)
REFERENCES livre(id),
CONSTRAINT fk_pret_id FOREIGN KEY (pret_id)
REFERENCES pret(id)
);
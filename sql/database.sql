CREATE DATABASE MagasinJouet;
USE MagasinJouet;

-- Table Jouet
CREATE TABLE Jouet (
    id_jouet INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    editeur VARCHAR(255) NOT NULL,
    marque VARCHAR(255) NOT NULL
);

-- Table Client
CREATE TABLE Client (
    id_client INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    telephone VARCHAR(20)
);

-- Table Commande
CREATE TABLE Commande (
    id_commande INT AUTO_INCREMENT PRIMARY KEY,
    id_client INT,
    date_commande DATE NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_client) REFERENCES Client(id_client) ON DELETE CASCADE
);

-- Table Fournisseur
CREATE TABLE Fournisseur (
    id_fournisseur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    contact VARCHAR(255),
    telephone VARCHAR(20)
);

-- Table de liaison entre Jouet et Fournisseur
CREATE TABLE Fournisseur_Jouet (
    id_fournisseur INT,
    id_jouet INT,
    quantite INT NOT NULL,
    PRIMARY KEY (id_fournisseur, id_jouet),
    FOREIGN KEY (id_fournisseur) REFERENCES Fournisseur(id_fournisseur) ON DELETE CASCADE,
    FOREIGN KEY (id_jouet) REFERENCES Jouet(id_jouet) ON DELETE CASCADE
);

-- Table de liaison entre Commande et Jouet
CREATE TABLE Commande_Jouet (
    id_commande INT,
    id_jouet INT,
    quantite INT NOT NULL,
    PRIMARY KEY (id_commande, id_jouet),
    FOREIGN KEY (id_commande) REFERENCES Commande(id_commande) ON DELETE CASCADE,
    FOREIGN KEY (id_jouet) REFERENCES Jouet(id_jouet) ON DELETE CASCADE
);

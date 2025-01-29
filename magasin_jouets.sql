-- Création de la base de données
CREATE DATABASE IF NOT EXISTS magasin_jouets;
USE magasin_jouets;

-- Création de la table Produit (table parent)
CREATE TABLE Produit (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    quantite_stock INT NOT NULL DEFAULT 0,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Création de la table Jouet qui hérite de Produit
CREATE TABLE Jouet (
    id INT PRIMARY KEY,
    age_min INT NOT NULL,
    age_max INT NOT NULL,
    marque VARCHAR(50) NOT NULL,
    categorie VARCHAR(50) NOT NULL,
    FOREIGN KEY (id) REFERENCES Produit(id) ON DELETE CASCADE
);

-- Création de la table Client
CREATE TABLE Client (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    adresse TEXT NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Création de la table Fournisseur
CREATE TABLE Fournisseur (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    adresse TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table de liaison entre Jouet et Fournisseur (relation many-to-many)
CREATE TABLE Jouet_Fournisseur (
    jouet_id INT,
    fournisseur_id INT,
    PRIMARY KEY (jouet_id, fournisseur_id),
    FOREIGN KEY (jouet_id) REFERENCES Jouet(id) ON DELETE CASCADE,
    FOREIGN KEY (fournisseur_id) REFERENCES Fournisseur(id) ON DELETE CASCADE
);

-- Création de la table Commande
CREATE TABLE Commande (
    id INT PRIMARY KEY AUTO_INCREMENT,
    client_id INT NOT NULL,
    date_commande TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    montant_total DECIMAL(10,2) NOT NULL DEFAULT 0,
    statut ENUM('en_attente', 'validée', 'en_préparation', 'expédiée', 'livrée', 'annulée') DEFAULT 'en_attente',
    FOREIGN KEY (client_id) REFERENCES Client(id)
);

-- Création de la table LigneCommande
CREATE TABLE LigneCommande (
    id INT PRIMARY KEY AUTO_INCREMENT,
    commande_id INT NOT NULL,
    jouet_id INT NOT NULL,
    quantite INT NOT NULL,
    prix_unitaire DECIMAL(10,2) NOT NULL,
    sous_total DECIMAL(10,2) GENERATED ALWAYS AS (quantite * prix_unitaire) STORED,
    FOREIGN KEY (commande_id) REFERENCES Commande(id) ON DELETE CASCADE,
    FOREIGN KEY (jouet_id) REFERENCES Jouet(id)
);

-- Triggers pour mettre à jour le montant total de la commande
DELIMITER //
CREATE TRIGGER after_ligne_commande_insert 
AFTER INSERT ON LigneCommande
FOR EACH ROW
BEGIN
    UPDATE Commande 
    SET montant_total = (
        SELECT SUM(sous_total) 
        FROM LigneCommande 
        WHERE commande_id = NEW.commande_id
    )
    WHERE id = NEW.commande_id;
END;//

CREATE TRIGGER after_ligne_commande_update
AFTER UPDATE ON LigneCommande
FOR EACH ROW
BEGIN
    UPDATE Commande 
    SET montant_total = (
        SELECT SUM(sous_total) 
        FROM LigneCommande 
        WHERE commande_id = NEW.commande_id
    )
    WHERE id = NEW.commande_id;
END;//

CREATE TRIGGER after_ligne_commande_delete
AFTER DELETE ON LigneCommande
FOR EACH ROW
BEGIN
    UPDATE Commande 
    SET montant_total = (
        SELECT SUM(sous_total) 
        FROM LigneCommande 
        WHERE commande_id = OLD.commande_id
    )
    WHERE id = OLD.commande_id;
END;//
DELIMITER ;
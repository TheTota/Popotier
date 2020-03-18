-- ------------------------------            BDD - Popotier            -----------------------------
-- ----------    Groupe Thomas CIANFARANI, Alexandre TOMASIA, Vanessa ASEJO CASPILLO    ------------


-- ---------------------------------------------------------------------------
-- Clear previous information.
-- ---------------------------------------------------------------------------
DROP DATABASE IF EXISTS db_popotier;
CREATE DATABASE db_popotier;

USE db_popotier;

-- ---------------------------------------------------------------------------
-- Initialize the structure.
-- ---------------------------------------------------------------------------
CREATE TABLE Role (
  	id INTEGER NOT NULL AUTO_INCREMENT,
    libelle VARCHAR(255) NOT NULL, 
    CONSTRAINT PK_Role PRIMARY KEY (id)
);

CREATE TABLE Utilisateur (
    email VARCHAR(255) NOT NULL,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    pseudo VARCHAR(255) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL, -- hash this
    id_role INTEGER NOT NULL,
    CONSTRAINT PK_Utilisateur PRIMARY KEY (email),
    CONSTRAINT FK_Utilisateur_Role FOREIGN KEY (id_role) REFERENCES Role(id)
);

CREATE TABLE Saison (
  	id INTEGER NOT NULL AUTO_INCREMENT,
    libelle VARCHAR(255) NOT NULL, 
    CONSTRAINT PK_Saison PRIMARY KEY (id)
);

CREATE TABLE Type (
  	id INTEGER NOT NULL AUTO_INCREMENT,
    libelle VARCHAR(255) NOT NULL, 
    CONSTRAINT PK_Type PRIMARY KEY (id)
);

CREATE TABLE Recette (
  	id INTEGER NOT NULL AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    image VARCHAR(255),
    temps_cuisson INTEGER,
    temps_preparation INTEGER,
    nb_personnes INTEGER,
    difficulte INTEGER,
    prix_moyen INTEGER,
    note_recette INTEGER,
    note_auteur INTEGER,
    email VARCHAR(255) NOT NULL,
    id_type INTEGER NOT NULL,
    CONSTRAINT PK_Recette PRIMARY KEY (id),
    CONSTRAINT FK_Recette_Utilisateur FOREIGN KEY (email) REFERENCES Utilisateur(email),
    CONSTRAINT FK_Recette_Type FOREIGN KEY (id_type) REFERENCES Type(id)
);

CREATE TABLE Saison_Recette (
  	id_saison INTEGER NOT NULL,
    id_recette INTEGER NOT NULL,
    CONSTRAINT PK_Saison_Recette PRIMARY KEY (id_saison, id_recette),
    CONSTRAINT FK_Saison_Recette_Saison FOREIGN KEY (id_saison) REFERENCES Saison(id),
    CONSTRAINT FK_Saison_Recette_Recette FOREIGN KEY (id_recette) REFERENCES Recette(id)
);

CREATE TABLE Tag (	   
  	id INTEGER NOT NULL AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL, 
    CONSTRAINT PK_Tag PRIMARY KEY (id)
);

CREATE TABLE Tag_Recette (
    id_tag INTEGER NOT NULL,
    id_recette INTEGER NOT NULL,
    CONSTRAINT PK_Tag_Recette PRIMARY KEY (id_tag, id_recette),
    CONSTRAINT FK_Tag_Recette_Tag FOREIGN KEY (id_tag) REFERENCES Tag(id),
    CONSTRAINT FK_Tag_Recette_Recette FOREIGN KEY (id_recette) REFERENCES Recette(id)
);

CREATE TABLE Etape (
	id INTEGER NOT NULL AUTO_INCREMENT,
    position INTEGER NOT NULL,
    description VARCHAR(255) NOT NULL,
    id_recette INTEGER NOT NULL,
    CONSTRAINT PK_Etape PRIMARY KEY (id),
    CONSTRAINT FK_Etape_Recette FOREIGN KEY (id_recette) REFERENCES Recette(id)
);

CREATE TABLE Commentaire (
	id INTEGER NOT NULL AUTO_INCREMENT, 
    description VARCHAR(255) NOT NULL,
    date_publication DATETIME, 
    email VARCHAR(255) NOT NULL,
    id_recette INTEGER NOT NULL,    
    CONSTRAINT PK_Commentaire PRIMARY KEY (id),
    CONSTRAINT FK_Commentaire_Utilisateur FOREIGN KEY (email) REFERENCES Utilisateur(email),
    CONSTRAINT FK_Commentaire_Recette FOREIGN KEY (id_recette) REFERENCES Recette(id)    
);

CREATE TABLE Utilisateur_Recette (
    email VARCHAR(255) NOT NULL,
    id_recette INTEGER NOT NULL,
    CONSTRAINT PK_Utilisateur_Recette PRIMARY KEY (email, id_recette),
    CONSTRAINT FK_Utilisateur_Recette_Utilisateur FOREIGN KEY (email) REFERENCES Utilisateur(email),
    CONSTRAINT FK_Utilisateur_Recette_Recette FOREIGN KEY (id_recette) REFERENCES Recette(id)
);

-- ---------------------------------------------------------------------------
-- Insert some data.
-- ---------------------------------------------------------------------------

INSERT INTO Role(libelle) 
VALUES("Admin");
INSERT INTO Role(libelle) 
VALUES("Utilisateur");

INSERT INTO Utilisateur(email, nom, prenom, pseudo, mot_de_passe, id_role)
VALUES ("defaultadmin@gmail.com", "Admin", "Default", "DefaultAdmin", "admin", 1);
INSERT INTO Utilisateur(email, nom, prenom, pseudo, mot_de_passe, id_role)
VALUES ("defaultuser@gmail.com", "User", "Default", "DefaultUser", "user", 2);


-- ------------------------------            BDD - Popotier            -----------------------------
-- ----------    Groupe Thomas CIANFARANI, Alexandre TOMASIA, Vanessa ASEJO CASPILLO    ------------


-- ---------------------------------------------------------------------------
-- Clear previous information.
-- ---------------------------------------------------------------------------
-- DROP DATABASE IF EXISTS db_popotier;
CREATE DATABASE IF NOT EXISTS popotier_bdd;

USE popotier_bdd;

-- ---------------------------------------------------------------------------
-- Initialize the structure.
-- ---------------------------------------------------------------------------
SET FOREIGN_KEY_CHECKS = 0;

DELETE IGNORE
FROM Utilisateur;
DELETE IGNORE
FROM Role;

DROP TABLE IF EXISTS Utilisateur_Recette;
DROP TABLE IF EXISTS Tag_Recette;
DROP TABLE IF EXISTS Saison_Recette;
DROP TABLE IF EXISTS Commentaire;
DROP TABLE IF EXISTS Etape;
DROP TABLE IF EXISTS Ingredient_Recette;
DROP TABLE IF EXISTS Ingredient;
DROP TABLE IF EXISTS Recette;
DROP TABLE IF EXISTS Saison;
DROP TABLE IF EXISTS Tag;
DROP TABLE IF EXISTS Type;
DROP TABLE IF EXISTS Utilisateur;
DROP TABLE IF EXISTS Role;
DROP TABLE IF EXISTS Ingredient_Recette;
DROP TABLE IF EXISTS Ingredient;
DROP TABLE IF EXISTS Note;
DROP TABLE IF EXISTS Allergene;

CREATE TABLE Role
(
    id      INTEGER      NOT NULL AUTO_INCREMENT,
    libelle VARCHAR(255) NOT NULL,
    CONSTRAINT PK_Role PRIMARY KEY (id)
);

DROP TABLE IF EXISTS Utilisateur;
CREATE TABLE Utilisateur
(
    id                INTEGER      NOT NULL AUTO_INCREMENT,
    email             VARCHAR(255) NOT NULL,
    nom               VARCHAR(255) NOT NULL,
    prenom            VARCHAR(255) NOT NULL,
    pseudo            VARCHAR(255) NOT NULL,
    mot_de_passe      VARCHAR(255) NOT NULL, -- hash this
    valide            BOOLEAN      NOT NULL DEFAULT 0,
    chaine_validation varchar(255),
    id_role           INTEGER      NOT NULL,
    date_creation     DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    CONSTRAINT PK_Utilisateur PRIMARY KEY (id),
    CONSTRAINT FK_Utilisateur_Role FOREIGN KEY (id_role) REFERENCES Role (id)
);



DROP TABLE IF EXISTS Saison;
CREATE TABLE Saison
(
    id      INTEGER      NOT NULL AUTO_INCREMENT,
    libelle VARCHAR(255) NOT NULL,
    CONSTRAINT PK_Saison PRIMARY KEY (id)
);

DROP TABLE IF EXISTS Type;
CREATE TABLE Type
(
    id      INTEGER      NOT NULL AUTO_INCREMENT,
    libelle VARCHAR(255) NOT NULL,
    CONSTRAINT PK_Type PRIMARY KEY (id)
);

DROP TABLE IF EXISTS Recette;
CREATE TABLE Recette
(
    id                INTEGER      NOT NULL AUTO_INCREMENT,
    nom               VARCHAR(255) NOT NULL,
    image             VARCHAR(255),
    date_creation     DATE         NOT NULL,
    temps_cuisson     INTEGER,
    temps_preparation INTEGER,
    nb_personnes      INTEGER,
    difficulte        INTEGER,
    prix_moyen        INTEGER,
    note_auteur       VARCHAR(255),
    id_auteur         INTEGER      NOT NULL,
    id_type           INTEGER      NOT NULL,
    valide            BOOLEAN DEFAULT 0,
    id_admin          VARCHAR(255),
    CONSTRAINT PK_Recette PRIMARY KEY (id),
    CONSTRAINT FK_Recette_Utilisateur FOREIGN KEY (id_auteur) REFERENCES Utilisateur (id),
    CONSTRAINT FK_Recette_Type FOREIGN KEY (id_type) REFERENCES Type (id)
);

DROP TABLE IF EXISTS Saison_Recette;
CREATE TABLE Saison_Recette
(
    id_saison  INTEGER NOT NULL,
    id_recette INTEGER NOT NULL,
    CONSTRAINT PK_Saison_Recette PRIMARY KEY (id_saison, id_recette),
    CONSTRAINT FK_Saison_Recette_Saison FOREIGN KEY (id_saison) REFERENCES Saison (id),
    CONSTRAINT FK_Saison_Recette_Recette FOREIGN KEY (id_recette) REFERENCES Recette (id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS Tag;
CREATE TABLE Tag
(
    id  INTEGER      NOT NULL AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL UNIQUE ,
    CONSTRAINT PK_Tag PRIMARY KEY (id),
    CONSTRAINT Unique_Tag UNIQUE (nom)
);

DROP TABLE IF EXISTS Tag_Recette;
CREATE TABLE Tag_Recette
(
    id_tag     INTEGER NOT NULL,
    id_recette INTEGER NOT NULL,
    CONSTRAINT PK_Tag_Recette PRIMARY KEY (id_tag, id_recette),
    CONSTRAINT FK_Tag_Recette_Tag FOREIGN KEY (id_tag) REFERENCES Tag (id),
    CONSTRAINT FK_Tag_Recette_Recette FOREIGN KEY (id_recette) REFERENCES Recette (id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS Etape;
CREATE TABLE Etape
(
    id          INTEGER      NOT NULL AUTO_INCREMENT,
    position    INTEGER      NOT NULL,
    description VARCHAR(255) NOT NULL,
    id_recette  INTEGER      NOT NULL,
    CONSTRAINT PK_Etape PRIMARY KEY (id),
    CONSTRAINT FK_Etape_Recette FOREIGN KEY (id_recette) REFERENCES Recette (id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS Commentaire;
CREATE TABLE Commentaire
(
    id               INTEGER      NOT NULL AUTO_INCREMENT,
    description      VARCHAR(255) NOT NULL,
    date_publication DATETIME,
    id_auteur        INTEGER      NOT NULL,
    id_recette       INTEGER      NOT NULL,
    CONSTRAINT PK_Commentaire PRIMARY KEY (id),
    CONSTRAINT FK_Commentaire_Utilisateur FOREIGN KEY (id_auteur) REFERENCES Utilisateur (id),
    CONSTRAINT FK_Commentaire_Recette FOREIGN KEY (id_recette) REFERENCES Recette (id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS Utilisateur_Recette;
CREATE TABLE Utilisateur_Recette
(
    id_utilisateur INTEGER NOT NULL,
    id_recette     INTEGER NOT NULL,
    CONSTRAINT PK_Utilisateur_Recette PRIMARY KEY (id_utilisateur, id_recette),
    CONSTRAINT FK_Utilisateur_Recette_Utilisateur FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur (id) ON DELETE CASCADE,
    CONSTRAINT FK_Utilisateur_Recette_Recette FOREIGN KEY (id_recette) REFERENCES Recette (id)
);

DROP TABLE IF EXISTS Utilisateur_Like_Recette;
CREATE TABLE Utilisateur_Like_Recette
(
    id_utilisateur INTEGER NOT NULL,
    id_recette     INTEGER NOT NULL,
    CONSTRAINT PK_Utilisateur_Like_Recette PRIMARY KEY (id_utilisateur, id_recette),
    CONSTRAINT FK_Utilisateur_Like_Recette_Utilisateur FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur (id) ON DELETE CASCADE,
    CONSTRAINT FK_Utilisateur_Like_Recette_Recette FOREIGN KEY (id_recette) REFERENCES Recette (id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS Ingredient;
CREATE TABLE Ingredient
(
    nom          VARCHAR(255) NOT NULL,
    id_allergene INTEGER,
    CONSTRAINT PK_Ingredient PRIMARY KEY (nom),
    CONSTRAINT FK_Allergene FOREIGN KEY (id_allergene) REFERENCES Allergene (id) ON DELETE NO ACTION
);

DROP TABLE IF EXISTS Unite;
CREATE TABLE Unite
(
    id  INTEGER      NOT NULL AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    CONSTRAINT PK_Unite PRIMARY KEY (id)
);

DROP TABLE IF EXISTS Ingredient_Recette;
CREATE TABLE Ingredient_Recette
(
    id_ingredient VARCHAR(255)      NOT NULL,
    id_recette    INTEGER           NOT NULL,
    quantite      INTEGER DEFAULT 1 NOT NULL,
    id_unite      INTEGER,
    CONSTRAINT PK_Ingredient_Recette PRIMARY KEY (id_ingredient, id_recette),
    CONSTRAINT FK_Ingredient_Recette_Ingredient FOREIGN KEY (id_ingredient) REFERENCES Ingredient (nom),
    CONSTRAINT FK_Ingredient_Recette_Recette FOREIGN KEY (id_recette) REFERENCES Recette (id) ON DELETE CASCADE,
    CONSTRAINT FK_Ingredient_Recette_Unite FOREIGN KEY (id_unite) REFERENCES Unite (id)
);

DROP TABLE IF EXISTS Note;
CREATE TABLE Note
(
    id             INTEGER NOT NULL AUTO_INCREMENT,
    valeur         TINYINT NOT NULL,
    id_recette     INTEGER NOT NULL,
    id_utilisateur INTEGER NOT NULL,
    CONSTRAINT PK_Note PRIMARY KEY (id),
    CONSTRAINT FK_Note_Recette FOREIGN KEY (id_recette) REFERENCES Recette (id),
    CONSTRAINT FK_Note_Utilisateur FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur (id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS Allergene;
CREATE TABLE Allergene
(
    id  INTEGER      NOT NULL AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    CONSTRAINT PK_Allergene PRIMARY KEY (id)
);

-- ---------------------------------------------------------------------------
-- TRIGGERS
-- ---------------------------------------------------------------------------
DELIMITER $$
CREATE TRIGGER `set_creation_date`
    BEFORE INSERT
    ON `Recette`
    FOR EACH ROW
BEGIN
    SET NEW.date_creation = NOW();
END
$$
DELIMITER ;

-- ---------------------------------------------------------------------------
-- Insert some data.
-- ---------------------------------------------------------------------------

INSERT INTO Role(libelle)
VALUES ("Admin");
INSERT INTO Role(libelle)
VALUES ("Utilisateur");

INSERT INTO Utilisateur(email, nom, prenom, pseudo, mot_de_passe, id_role)
VALUES ("defaultadmin@gmail.com", "Admin", "Default", "DefaultAdmin", "admin", 1);
INSERT INTO Utilisateur(email, nom, prenom, pseudo, mot_de_passe, id_role)
VALUES ("defaultuser@gmail.com", "User", "Default", "DefaultUser", "user", 2);

SET FOREIGN_KEY_CHECKS = 1;


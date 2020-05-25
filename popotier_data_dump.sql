-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: mysql-popotier.alwaysdata.net
-- Generation Time: Apr 16, 2020 at 02:57 PM
-- Server version: 10.4.12-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `popotier_bdd`
--

--
-- Dumping data for table `Allergene`
--

INSERT INTO `Allergene` (`nom`) VALUES
('Gluten'),
('Arachide'),
('Poisson'),
('Oeuf'),
('Soja'),
('Lait');

INSERT INTO `Unite` (`nom`) VALUES
(NULL),
('ml'),
('cl'),
('l'),
('mg'),
('g'),
('kg'),
('cuillère a soupe'),
('cuillère a café');

--
-- Dumping data for table `Tag`
--

INSERT INTO `Tag` (`nom`) VALUES
('Vegan'),
('Noël'),
('Ete'),
('Hiver'),
('Paque');

--
-- Dumping data for table `Type`
--

INSERT INTO `Type` (`libelle`) VALUES
('Entrée'),
('Plat'),
('Dessert'),
('Boisson');

--
-- Dumping data for table `Role`
--

INSERT INTO `Role` (`libelle`) VALUES
('Admin'),
('Utilisateur');

--
-- Dumping data for table `Utilisateur`
--

-- INSERT INTO `Utilisateur` (`email`, `nom`, `prenom`, `pseudo`, `mot_de_passe`, `id_role`) VALUES
-- ('defaultadmin@gmail.com', 'Admin', 'Default', 'DefaultAdmin', 'admin', 1),
-- ('defaultuser@gmail.com', 'User', 'Default', 'DefaultUser', 'user', 2);

--
-- Dumping data for table `Recette`
--

INSERT INTO `Recette` (`nom`, `image`, `date_creation`, `temps_cuisson`, `temps_preparation`, `nb_personnes`, `difficulte`, `prix_moyen`, `note_auteur`, `id_auteur`, `id_type`, `valide`, `id_admin`) VALUES
('Barbajuan', NULL, '2020-04-14', NULL, 60, 4, NULL, NULL, 'A manger froid ou chaud !', 2, 1, 0, NULL),
('Tarte Thon, Tomates & Moutardes', NULL, '2020-04-14', 40, 15, NULL, NULL, 8, NULL, 2, 2, 0, NULL),
('Ganses', NULL, '2020-04-14', NULL, 90, 4, 5, NULL, 'A déguster froid !', 2, 3, 0, NULL);

--
-- Dumping data for table `Etape`
--

INSERT INTO `Etape` (`position`, `description`, `id_recette`) VALUES
( 1, 'Commencer par mettre à bouillir de l’eau, une fois en ébullition, y mettre le riz et la courge (ou blettes).', 1),
( 2, 'Pour la pâte, commencer par mettre la farine avec le sel et les œufs dans un saladier. Mélanger le tout en rajoutant l’eau et l’huile. La pâte doit être maniable et ferme.', 1),
( 3, 'Etaler la pâte sur le plan de travail et l’aplatir avec un rouleau.', 1),
( 4, 'D’un autre côté, faire revenir les oignons à la poêle avec de l’ail. Préparer la farce en utilisant le riz et la courge (ou blettes) cuits. Couper la courge, les oignons et le persil en petits morceaux et mélanger tous les ingrédients de la farce en incorporant poivre et sel si besoin.', 1),
( 5, 'Ensuite avec une cuillère à soupe, déposer la farce par petit tas sur la pâte (veiller à ce que la farce ne fasse pas de jus) et refermer avec de la pâte par-dessus afin d’obtenir un lingot. La farce ne doit pas pouvoir sortir de la pâte.\r\nRépéter l’opération jusqu’à ne plus avoir de pâte.', 1),
( 6, 'Plonger les barbajuans dans l’huile bouillante et tourner les afin que les deux côtés soient dorés.', 1),
( 7, 'Déposer les sur un sopalin pour éviter que l’huile s’accumule. ', 1),
( 8, 'D’un autre côté, faire revenir les oignons à la poêle avec de l’ail. Préparer la farce en utilisant le riz et la courge (ou blettes) cuits. Couper la courge, les oignons et le persil en petits morceaux et mélanger tous les ingrédients de la farce en incorporant poivre et sel si besoin.', 1),
( 9, 'Ensuite avec une cuillère à soupe, déposer la farce par petit tas sur la pâte (veiller à ce que la farce ne fasse pas de jus) et refermer avec de la pâte par-dessus afin d’obtenir un lingot. La farce ne doit pas pouvoir sortir de la pâte.\r\nRépéter l’opération jusqu’à ne plus avoir de pâte.', 1),
( 10, 'Plonger les barbajuans dans l’huile bouillante et tourner les afin que les deux côtés soient dorés.', 1),
( 11, 'Déposer les sur un sopalin pour éviter que l’huile s’accumule. ', 1),
( 1, 'Préchauffez votre four , 200°C (Th.7) pendant 10 min.', 2),
( 2, 'Déroulez la pâte avec le papier de cuisson dans votre moule à tarte et piquez-la à l\'aide d\'une fourchette.', 2),
( 3, 'Recouvrez votre tarte d\'une fine couche de moutarde.', 2),
( 4, 'Emiettez le thon et répartissez-le sur le fonc de la pâte.', 2),
( 5, 'Lavez les tomates, puis coupez-lez en rondelles moyennes, et disposez-les sur le thon.', 2),
( 6, 'Battez les oeufs, ajoutez la crème fraîche, le lait, l\'emmental râpé, le sel, le poivre et les herbes de Provence.', 2),
( 7, 'Etalez ce mélange sur la pâte, le thon et les tomates.', 2),
( 8, 'Faites cuire à 200°C (Th.7) pendant 40 min dans le bas de votre four.', 2),
( 1, 'Afin de ne pas rencontrer de désordre durant la cuisine, préparer deux saladiers.', 3),
( 2, 'Séparer les jaunes et les blancs des 3 œufs dans les deux saladiers.', 3),
( 3, 'Dans le premier saladier avec les jaunes, ajouter les 3 cuillères d’huiles, 2 cuillères de sucres, 250 grammes de farine, le zest de citron ainsi que le jus du citron (quantité selon les goûts) et mélanger le tout jusqu’à obtenir une couleur blanchâtre et homogène.', 3),
( 4, 'Dans le deuxième saladier, monter les blancs en neige. Ensuite dans un second temps incorporer-les dans le mélange du premier saladier.', 3),
( 5, 'Mélanger le tout et ajouter le reste de farine. A cet instant, la pâte doit avoir une consistance assez lisse et ne doit pas coller, elle doit rester ferme. Dans le cas contraire, rajouter autant de farine que nécessaire pour obtenir ce résultat.', 3),
( 6, 'A côté, préparer une place avec de la farine afin d’y déposer la pâte pour la travailler. Utiliser le rouleau à pâtisserie pour obtenir une pâte fine.', 3),
( 7, 'Couper la pâte en bandes espacées d’environ 1, 74 cm (oui c’est précis), former des nœuds ou des torsades selon la longueur des bandes.', 3),
( 8, 'Plonger les ganses dans l’huile à frire chaude et tourner les lorsque la ganse devient dorée.', 3),
( 9, 'Poser les ganses chaudes sur un sopalin et ajouter le sucre glace.', 3);

INSERT INTO Ingredient (nom, id_allergene)
VALUES
    ('tomate', null),
    ('thon', null),
    ('moutarde', null),
    ('farine', 1),
    ('riz', null),
    ('courge', null),
    ('sel', null),
    ('oeuf', 4),
    ('huile', null),
    ('eau', null);

INSERT INTO Ingredient_Recette (id_ingredient, id_recette, quantite, id_unite)
VALUES
    ('tomate', 2, 2, null),
    ('thon', 2, 200, 5),
    ('moutarde', 2, 50, 5);


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

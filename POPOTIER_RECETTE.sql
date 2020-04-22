INSERT INTO Type(libelle) VALUES('Entrée');
INSERT INTO Type(libelle) VALUES('Plat');
INSERT INTO Type(libelle) VALUES('Dessert');
INSERT INTO Type(libelle) VALUES('Boisson');

INSERT INTO `Allergene` (`id`, `nom`) VALUES (NULL, 'gluten'), (NULL, 'crustacés');

INSERT INTO Recette(nom,temps_preparation,nb_personnes,note_recette, note_auteur, id_auteur, id_type) 
VALUES('Barbajuan',60, 4,8,'A manger froid ou chaud !', 'defaultuser@gmail.com', 1);

INSERT INTO Recette (nom,temps_cuisson,temps_preparation,nb_personnes,note_recette, id_auteur, id_type) VALUES('Tarte Thon, Tomates & Moutardes',40, 15, 6,8, 'defaultadmin@gmail.com', 2);

INSERT INTO Recette (nom,temps_preparation,nb_personnes,difficulte, note_auteur, id_auteur, id_type) VALUES('Ganses', 90,4,5,'A déguster froid !', 'defaultuser@gmail.com', 3);

## MODELE ##
# INSERT INTO Recette       (nom,temps_cuisson,temps_preparation,nb_personnes,difficulte,prix_moyen,note_recette, note_auteur, id_auteur, id_type) VALUES();


## BARBAJUANS
INSERT INTO Etape (position, description, id_recette)
VALUES(1, 'Commencer par mettre à bouillir de l’eau, une fois en ébullition, y mettre le riz et la courge (ou blettes).', 4);

INSERT INTO Etape (position, description, id_recette)
VALUES(2,'Pour la pâte, commencer par mettre la farine avec le sel et les œufs dans un saladier. Mélanger le tout en rajoutant l’eau et l’huile. La pâte doit être maniable et ferme.', 4);

INSERT INTO Etape (position, description, id_recette)
VALUES(3,'Etaler la pâte sur le plan de travail et l’aplatir avec un rouleau.', 4);


INSERT INTO Etape (position, description, id_recette)
VALUES(4,'D’un autre côté, faire revenir les oignons à la poêle avec de l’ail. Préparer la farce en utilisant le riz et la courge (ou blettes) cuits. Couper la courge, les oignons et le persil en petits morceaux et mélanger tous les ingrédients de la farce en incorporant poivre et sel si besoin.', 4);

INSERT INTO Etape (position, description, id_recette)
VALUES(5,'Ensuite avec une cuillère à soupe, déposer la farce par petit tas sur la pâte (veiller à ce que la farce ne fasse pas de jus) et refermer avec de la pâte par-dessus afin d’obtenir un lingot. La farce ne doit pas pouvoir sortir de la pâte.
Répéter l’opération jusqu’à ne plus avoir de pâte.', 4);

INSERT INTO Etape (position, description, id_recette)
VALUES(6,'Plonger les barbajuans dans l’huile bouillante et tourner les afin que les deux côtés soient dorés.', 4);

INSERT INTO Etape (position, description, id_recette)
VALUES(7,'Déposer les sur un sopalin pour éviter que l’huile s’accumule. ', 4);

INSERT INTO Etape (position, description, id_recette)
VALUES(8,'D’un autre côté, faire revenir les oignons à la poêle avec de l’ail. Préparer la farce en utilisant le riz et la courge (ou blettes) cuits. Couper la courge, les oignons et le persil en petits morceaux et mélanger tous les ingrédients de la farce en incorporant poivre et sel si besoin.', 4);

INSERT INTO Etape (position, description, id_recette)
VALUES(9,'Ensuite avec une cuillère à soupe, déposer la farce par petit tas sur la pâte (veiller à ce que la farce ne fasse pas de jus) et refermer avec de la pâte par-dessus afin d’obtenir un lingot. La farce ne doit pas pouvoir sortir de la pâte.
Répéter l’opération jusqu’à ne plus avoir de pâte.', 4);

INSERT INTO Etape (position, description, id_recette)
VALUES(10,'Plonger les barbajuans dans l’huile bouillante et tourner les afin que les deux côtés soient dorés.', 4);

INSERT INTO Etape (position, description, id_recette)
VALUES(11,'Déposer les sur un sopalin pour éviter que l’huile s’accumule. ', 4);

## TARTE THON TOMATE ET MOUTARDE
INSERT INTO Etape (position, description, id_recette)
VALUES(1, 'Préchauffez votre four , 200°C (Th.7) pendant 10 min.', 5);

INSERT INTO Etape (position, description, id_recette)
VALUES(2,'Déroulez la pâte avec le papier de cuisson dans votre moule à tarte et piquez-la à l\'aide d\'une fourchette.', 5);

INSERT INTO Etape (position, description, id_recette)
VALUES(3,'Recouvrez votre tarte d\'une fine couche de moutarde.', 5);

INSERT INTO Etape (position, description, id_recette)
VALUES(4,'Emiettez le thon et répartissez-le sur le fonc de la pâte.', 5);

INSERT INTO Etape (position, description, id_recette)
VALUES(5,'Lavez les tomates, puis coupez-lez en rondelles moyennes, et disposez-les sur le thon.', 5);

INSERT INTO Etape (position, description, id_recette)
VALUES(6, 'Battez les oeufs, ajoutez la crème fraîche, le lait, l\'emmental râpé, le sel, le poivre et les herbes de Provence.', 5);

INSERT INTO Etape (position, description, id_recette)
VALUES(7, 'Etalez ce mélange sur la pâte, le thon et les tomates.', 5);

INSERT INTO Etape (position, description, id_recette)
VALUES(8, 'Faites cuire à 200°C (Th.7) pendant 40 min dans le bas de votre four.', 5);


## GANSES 
INSERT INTO Etape (position, description, id_recette)
VALUES(1,'Afin de ne pas rencontrer de désordre durant la cuisine, préparer deux saladiers.', 6);

       
INSERT INTO Etape (position, description, id_recette)
VALUES(2,'Séparer les jaunes et les blancs des 3 œufs dans les deux saladiers.' , 6);

       
INSERT INTO Etape (position, description, id_recette)
VALUES(3,'Dans le premier saladier avec les jaunes, ajouter les 3 cuillères d’huiles, 2 cuillères de sucres, 250 grammes de farine, le zest de citron ainsi que le jus du citron (quantité selon les goûts) et mélanger le tout jusqu’à obtenir une couleur blanchâtre et homogène.', 6);

INSERT INTO Etape (position, description, id_recette)
VALUES(4,'Dans le deuxième saladier, monter les blancs en neige. Ensuite dans un second temps incorporer-les dans le mélange du premier saladier.', 6);


INSERT INTO Etape (position, description, id_recette)
VALUES(5, 'Mélanger le tout et ajouter le reste de farine. A cet instant, la pâte doit avoir une consistance assez lisse et ne doit pas coller, elle doit rester ferme. Dans le cas contraire, rajouter autant de farine que nécessaire pour obtenir ce résultat.', 6);


INSERT INTO Etape (position, description, id_recette)
VALUES(6,'A côté, préparer une place avec de la farine afin d’y déposer la pâte pour la travailler. Utiliser le rouleau à pâtisserie pour obtenir une pâte fine.', 6);


INSERT INTO Etape (position, description, id_recette)
VALUES(7, 'Couper la pâte en bandes espacées d’environ 1, 74 cm (oui c’est précis), former des nœuds ou des torsades selon la longueur des bandes.', 6);


INSERT INTO Etape (position, description, id_recette)
VALUES(8, 'Plonger les ganses dans l’huile à frire chaude et tourner les lorsque la ganse devient dorée.', 6);



INSERT INTO Etape (position, description, id_recette)
VALUES(9,'Poser les ganses chaudes sur un sopalin et ajouter le sucre glace.', 6);


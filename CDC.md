# Cahier des charges
Équipe Alexandre Tomasia, Thomas Cianfarani et Vanessa Asejo Caspillo.

## Contexte
Dans le cadre du cours de "Programmation Web" de la formation d'ingénieur informatique STMN (Sciences et Technologies des Médias Numériques) du CNAM (Conservatoire National des Arts et Métiers), un projet est demandé afin de distribuer une note d'évaluation continue aux élèves. Pour le projet suivant, l'enseignant de cette matière M. BACQUET fera donc figure de client.

## Problématique 
Le projet concerne l'élaboration d'un site web de recettes de cuisine, offrant nombre de fonctionnalités à la fois administratives et publiques. Le but est d'obtenir un site similaire à [marmiton.org](https://www.marmiton.org/), que l'équipe nommera "Popotier".
Afin de parvenir à ce résultat, plusieurs problèmatiques se posent :

- Comment permettre aux utilisateurs de rechercher et filtrer efficacement les recettes présentes sur le site ?
- Comment offrir aux utilisateurs un espace personnel contenant un livre de recettes qu'ils pourront compléter avec leurs propres recettes ?
- Comment constituer une feuille de recette complète et instructive ?
- Comment gérer la validation des recettes proposées par un administrateur ?

## Besoin
Les besoins principaux du site Popotier sont:

- Permettre aux utilisateurs de consulter le site et les recettes sans être inscrits et de filtrer les recettes
- Permettre à l'utilisateur de s'inscrire sur le site, ainsi que de valider son inscription à la suite de la réception d'un mail de confirmation
- Permettre à un utilisateur inscrit de se connecter à un compte existant
- Permettre à un utilisateur inscrit de faire une récupération de mot de passe s'il a oublié le sien
- Permettre à un utilisateur inscrit de modifier les informations de son compte
- Permettre à un utilisateur inscrit de consulter son livre de recettes 
- Permettre à un utilisateur inscrit de proposer, visualiser et valider une recette présentée sous forme d'algorithme et aggrémentée d'informations sur le temps de préparation, temps de cuisson, si la recette est vegan ou non, de quel type de plat il s'agit, etc...
- Permettre à un administrateur de valider les recettes proprosées 
- Permettre à un administrateur de lister les allergies connues 
- Permettre à un administrateur d'ajouter des options/labels que les utilisateurs pourront utiliser pour caractériser davantage leur recette

## Solution
Pour répondre à ces besoins, notre équipe notamment forte de deux personnes exercant leur apprentissage dans le milieu du développement web, est diposée à la réalisation du site Popotier, intrégrant les fonctionnalités découlant des besoins émits par le client.

### Solution fonctionelles
  Les fonctionnalités offertes par le site web :
  - Espace public : Visualisation et filtrage des recettes disponibles sur une page dédiée
  - Espace utilisateur : pouvoir s'enregistrer, se connecter, modifier ses informations personnelles, faire une récupération de mot de passe, consulter son livre de recettes, ajouter ou modifier une recette
  - Espace administratif : pouvoir valider des recettes, lister les allergies connues, éditer ou ajouter des labels concernant les recettes
 
### Solution techniques
D'un point de vue technique, nous proposons d'intégrer des technologies éprouvées, performantes et peu onéreuses :
- Une base de données MariaDB pour la gestion et la manipulation des données. 
- Serveur Web Apache pour la délivrance des pages Web. Apache est aujourd'hui le serveur le plus populaire et dispose de nombreux modules.
- Le framework open source CSS Bootstrap pour l'affichage esthétique des pages et de leur contenu. 
- PHP natif pour le back-end du site.

## Livrables
L'intégralité du site web réalisé sera livré au client sous forme d'archive .zip contenant tous les fichiers nécessaires à son fonctionnement.

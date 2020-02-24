# Cahier des charges
Équipe Alexandre Tomasia,Thomas Cianfarani et Vanessa Asejo Caspillo.

## Contexte
Depuis le 13 septembre 1985, la boutique MicroGameZone vend des jeux vidéo sur toutes les plateformes. Aujourd'hui, MicroGameZone est devenu une franchise et possède 43 boutiques en France. Au cours des 5 dernières années, la clientèle s'est vue diminuer de 30% à cause de la dématérialisation des jeux et la multiplication des plateformes de vente en ligne. La perte de chiffre dûe à la baisse de clientèle rend difficile le financement des magasins physique.

## Problématique 
MicroGameZone se rend compte que les boutiques physique ne sont plus rentables à cause des différentes charges (location des locaux, employès... etc) et de la concurrence des différentes boutiques en ligne.
Le CEO de MicroGameZone souhaite donc passer sur un modèle de vente exclusivement en ligne. Plusieurs problèmatiques se posent donc:

- Comment gérer le stock de jeux video disponibles à la vente ?
- Comment gérer les ventes en ligne ?
- Comment offrir aux client un espace relatif à leur activité sur le site ?
- Comment faire la transition entre vente en magasin et vente en ligne ?

## Besoin
Les besoins principaux de MicroGameZone sont:

- Pouvoir présenter une liste des jeux vidéo disponibles à la vente au client.
- Pouvoir effectuer une commande de un ou plusieurs jeux vidéo.
- Pouvoir permettre au client d'acceder a son espace a partir duquel il peut consulter son activité sur le site.
- Pouvoir gérer le stock des jeux disponibles à la vente.


## Solution
Pour répondre à ce besoin, notre société a la solution ! Fort de 2 mois d'expérience dans les bases de données, nous sommes peut-être presque sûrs des solutions à mettre en place pour transformer MicroGameZone en nouveau Amazon du jeu video.

### Solution fonctionelles
  Les fonctionnalités offertes par l'application:
  - Système de gestion des jeux disponibles à la vente.
  - Gestion des achats.
  - Espace client : pouvoir s'enregistrer, se connecter, modifier ses informations personnelles, visualiser son historique des achats, consulter son panier pour la session courante.
  - Système de gestion de stock.
  
### Solution techniques
D'un point de vue technique, nous proposons d'intégrer des technologies éprouvées, performantes et peu onéreuses :
- Une base de données PostgreSQL pour la gestion et la manipulation des données. PostgreSQL est une base de données libre, sans coût de licence, et elle existe depuis plus de 20 ans.
- Serveur Web Apache pour la délivrance des pages Web. Apache est aujourd'hui le serveur le plus populaire et dispose de nombreux modules.
- Angular pour le front-end avec un back-end php qui recupérera les données depuis la BDD. 
- Docker pour le packaging de l'application dans un environnement maîtrisée et cloisonné.
Le prérequis technique pour la mise en service de la solution est de disposer d'une machine Windows Professionnal disposant du logiciel Docker. 

## Livrables
Pour faciliter la mise en production, nous proposerons une machine "clefs en main" avec l'ensemble des composants déjà installés.

Lors des mises à jours, l'administrateur du système devra suivre la procédure suivante :
- Stopper les services 
```
docker-compose down
```
- Télécharger les mises à jours
```
git pull
```
- Redémarrer les services
```
docker-compose up
```

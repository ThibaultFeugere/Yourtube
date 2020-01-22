# YourTube

## Procédure de mise en place du projet

- Cloner le projet
- Configurer le .env en accord avec votre configuration
- Créer une base de donnée nommée : yourtube
- Effectuer la commande : `composer install` puis `npm run dev`
- Réaliser la commande : `php artisan migrate:refresh --seed`
- Lancer le serveur avec la commande : `php artisan serve`
- Yourtube est accessible sur l'adresse 127.0.0.1:800 !

### Informations utiles

Un compte par défaut est créé. Vous pouvez donc vous connecter sans avoir à vous inscrire. 

Le compte créé est :

- mail : admin@yourtube.fr
- mdp : M0td3p4ss3

## Fonctionnalités

### Authentification

- Connexion au compte
- Inscription du compte
- Réinitialisation du mot de passe
- Suppression du compte

### Vidéo

- Upload d'une vidéo
- Modification d'une vidéo
- Suppression d'une vidéo
- Partage d'une vidéo
- Like / Dislike d'une vidéo
- Signalement d'une vidéo
- Commenter une vidéo

### Administration

- Modération des vidéos
- Modération des utilisateurs (rôles / suppression)
- Modération des signalements
- Modération des commentaires

### Utilisation

- Visionnage d'une vidéo
- Recherche d'une vidéo
- Recherche d'un profil
- Visionnage public d'un profil

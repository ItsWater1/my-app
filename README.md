# Projet Jeunesse Treycovagnes - Chamblon

## Description

Ce projet est un site web développé en PHP, destiné à gérer les manifestations de la Jeunesse de Treycovagnes - Chamblon. Le site permet de créer, modifier, supprimer et afficher des manifestations dans un calendrier. De plus, il propose un album photo où les utilisateurs peuvent ajouter leurs propres photos et les trier par date ou lieu.

## Fonctionnalités

### Utilisateur

- **Connexion et Déconnexion :** Les utilisateurs peuvent se connecter et se déconnecter du site via un formulaire de connexion sécurisé.
- **Album Photo :** Les utilisateurs peuvent ajouter des photos, qui sont ensuite affichées dans l'album. Ils peuvent également visualiser et supprimer leurs propres photos.
- **Tri des Photos :** Les photos peuvent être triées par date ou par lieu pour une recherche plus facile.

### Administrateur

- **Gestion des Manifestations :** Les administrateurs peuvent ajouter, modifier et supprimer des manifestations.
- **Gestion des Utilisateurs :** Les administrateurs peuvent gérer les utilisateurs en créant de nouveaux comptes, en modifiant les droits d'accès et en supprimant des utilisateurs.
- **Gestion des Images :** Les administrateurs ont une vue globale des images téléchargées par tous les utilisateurs et peuvent les supprimer si nécessaire.

## Prérequis

- Un serveur Web (Apache, Nginx, etc.)
- PHP installé sur le serveur
- Une base de données MySQL
- Accès à un outil de gestion de base de données (phpMyAdmin, MySQL Workbench, etc.)

## Installation

1. **Configurer le Serveur Web :** Assurez-vous que votre serveur Web est configuré et en cours d'exécution.
2. **Initialiser la Base de Données :** Utilisez le dump SQL fourni pour initialiser la base de données nécessaire.
3. **Configurer les Paramètres de la Base de Données :** Modifiez les paramètres de connexion à la base de données dans le fichier `DB_connexion.php`.
4. **Lancer le Site :** Accédez au site via votre navigateur web.

## Structure du Projet

### Fichiers et Répertoires Principaux

- **DB_connexion.php :** Gère la connexion à la base de données.
- **nav.php, nav_adm.php :** Barre de navigation pour les utilisateurs et les administrateurs.
- **footer.php :** Pied de page commun à toutes les pages.
- **Image_model.php :** Contient les fonctions pour gérer les images (ajout, suppression, récupération).
- **manif :** Répertoire contenant les scripts de gestion des manifestations (ajout, modification, suppression).
- **user :** Répertoire contenant les scripts de gestion des utilisateurs (création, modification de mot de passe, suppression).

### Exemples de Pages

- **index.php :** Page d'accueil avec le calendrier des manifestations.
- **album.php :** Affiche les photos ajoutées par les utilisateurs.
- **login.php :** Formulaire de connexion.
- **admin.php :** Tableau de bord de l'administrateur.
- **image_upload.php :** Script pour téléverser des images.
- **image_delete.php :** Script pour supprimer des images.
- **user_create.php :** Formulaire pour créer un nouvel utilisateur.
- **user_lvl_modifier.php :** Formulaire pour modifier le niveau de droits d'un utilisateur.
- **user_mdp_modifier.php :** Formulaire pour modifier le mot de passe d'un utilisateur.

## Instructions d'Utilisation

1. **Connexion :** Utilisez l'un des comptes administrateur ou utilisateur fournis pour vous connecter.
2. **En tant qu'Administrateur :**
   - Accédez à la section de gestion des manifestations pour ajouter, modifier ou supprimer des événements.
   - Utilisez la section de gestion des utilisateurs pour gérer les comptes utilisateur.
   - Visualisez et gérez les images téléchargées par les utilisateurs.
3. **En tant qu'Utilisateur :**
   - Téléversez des photos dans l'album via le formulaire dédié.
   - Triez les photos par date ou par lieu pour une recherche plus facile.
   - Supprimez vos propres photos si nécessaire.

## Sécurité

- **Validation des Entrées :** Les formulaires valident les données avant de les traiter pour éviter les injections SQL.
- **Requêtes Préparées :** Utilisation de requêtes préparées pour les interactions avec la base de données.
- **Gestion des Sessions :** Les utilisateurs doivent se connecter pour accéder à la plupart des fonctionnalités du site.

## Auteurs

Ce projet a été développé par la Jeunesse de Treycovagnes - Chamblon.

Pour toute question ou assistance, veuillez contacter [arthur.wuthrich@eduvaud.ch](mailto:arthur.wuthrich@eduvaud.ch).

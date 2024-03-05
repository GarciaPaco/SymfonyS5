
# WR506 - Movie API - PACO GARCIA - 2024

### Prérequis

- [Php 8.1](https://www.php.net/downloads)
- [Composer](https://getcomposer.org/download/)
- [Symfony CLI](https://symfony.com/download)
- OpenSSL (pour générer les clés JWT)
- Projet Frontend [WR505](https://github.com/GarciaPaco/S5VueJSTD2) (optionnel)

### Installation

1. Cloner le projet en local
2. Installer les dépendances
    ```bash
    composer install
    ```
3. Créer le fichier .env.local et renseigner les variables d'environnement nécessaires
    ```bash
    cp .env .env.local
    ```
4. Renseigner les variables suivantes :
    ```dotenv
    DATABASE_URL #(url et login de la base de données)
    ```
5. Créer la base de données
    ```bash
    php bin/console d:d:c
    php bin/console d:s:u
    ```
6. Créer les fixtures
    ```bash
    php bin/console d:f:l
    ```
7. Générer les clés JWT
    ```bash
    php bin/console lexik:jwt:generate-keypair
    ```
8. Lancer le serveur si besoin (solution alternative avec Laragon ou autre)
    ```bash
    symfony server:start
    ```

La documentation de l'API est disponible à l'adresse suivante : [http://localhost:8000/api/doc](http://localhost:8000/api/docs)

Les identifiants par défaut pour se connecter à l'API sont les suivants :

```
Utilisateur :
    username: exemple1@gmail.com
    password: test

```

### Fonctionnalités

- [x] Fixtures
- [x] Authentification
- [x] Assert
- [x] Recherche
- [x] Upload
- [x] Pagination
- [x] Modification et suppression des films

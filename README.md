# Projet Symphonie
 API Live : [https://projet-perso-symphonie-production.up.railway.app](https://projet-perso-symphonie-production.up.railway.app/api/concerts)
## Contexte

Dans le cadre de mon apprentissage personnel, j'ai voulu découvrir et maîtriser Symfony, un framework PHP professionnel utilisé dans de nombreuses entreprises. Pour cela, j'ai décidé de construire un projet concret de A à Z : une API REST de gestion et réservation de concerts.

Ce projet m'a permis de passer de zéro connaissance sur Symfony à une API fonctionnelle avec authentification JWT, base de données relationnelle et déploiement en production.

---

## Ce que j'ai appris et construit

### Stack technique
- PHP 8.2
- Symfony 6.4
- MySQL avec Doctrine ORM
- JWT(LexikJWTAuthenticationBundle)
- Postman pour les tests API

### Fonctionnalités développées

#### Architecture
- Projet Symfony structuré avec séparation des responsabilités (Entity, Repository, Controller)
- Gestion des dépendances avec Composer
- Migrations de base de données avec Doctrine Migrations

### Base de données
- Entité User — gestion des utilisateurs avec rôles
- Entité Concert — titre, date, prix, nombre de places
- Entité Salle — nom, capacité, adresse, ville
- Relation ManyToOne entre Concert et Salle

### API REST
- `GET /api/concerts` — liste tous les concerts (public)
- `GET /api/concerts/{id}` — détail d'un concert (public)
- `POST /api/concerts` — créer un concert (authentifié)
- `DELETE /api/concerts/{id}` — supprimer un concert (authentifié)
- `GET /api/salles` — liste toutes les salles (public)
- `POST /api/salles` — créer une salle (authentifié)

#### Authentification JWT
- `POST /api/auth/register` — inscription
- `POST /api/auth/login` — connexion et génération du token JWT
- Routes protégées par token Bearer
- Hashage des mots de passe avec Symfony PasswordHasher

---

## Installation

# Cloner le projet
git clone https://github.com/DEVRayan-gif/projet-perso-symphonie.git
cd projet-perso-symphonie

# Installer les dépendances
composer install

# Configurer la base de données dans .env
DATABASE_URL="mysql://root:MOTDEPASSE@127.0.0.1:3306/symphonie"

# Créer la base de données
php bin/console doctrine:database:create

# Exécuter les migrations
php bin/console doctrine:migrations:migrate

# Lancer le serveur
symfony server:start

---

## Tests API avec Postman

---

## Ce que ce projet m'a apporté

- Comprendre l'architecture MVC de Symfony
- Maîtriser Doctrine ORM et les relations entre entités
- Implémenter une authentification JWT
- Construire une API REST propre et sécurisée

---

## Auteur

Projet personnel réalisé pour apprendre Symfony et le développement backend.

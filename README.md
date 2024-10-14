# Documentation du projet e-commerce symfony: Stubborn


## 1. Introduction

Ce projet est une application e-commerce développée en
Symfony. Elle permet de gérer un panier d'achat, de passer des
commandes et de réaliser des paiements avec Stripe. Elle permet
également à un administrateur d’ajouter, de modifier ou de retirer
des produits facilement.

## 2. Table des matières

1. [Pré-requis](#pré-requis)
2. [Installation](#installation)
3. [Configuration](#configuration)
4. [Utilisation](#utilisation)
5. [Structure du projet](#structure-du-projet)
6. [Fonctionnalités principales](#fonctionnalités-principales)

  
## 3. Pré-requis

Avant de démarrer, assurez-vous que les outils suivants sont
installés :
- PHP 8.x
- Composer
- Symfony CLI
- MySQL ou MariaDB
- Un compte Stripe

## 4. Installation
  
 ## 4.1. Clonage du projet
 
git clone https://github.com/Symfony_e_commerc
cd mon-projet

## 4.2. Installation des dépendances

composer install

## 4.3. Configuration de l'environnement

Créez le fichier .env et configurez les variables suivantes :
• DATABASE_URL
• STRIPE_SECRET_KEY
• STRIPE_PUBLIC_KEY
• MESSENGER_TRANSPORT_DSN
• MAILER_DSN

## 4.4. Création de la base de données

symfony console doctrine:database:create
symfony console doctrine:migrations:migrate

## 4.5. Démarrage du serveur

symfony serve:start

## 5. Configuration
## 5.1. Fichier .env

Les variables d'environnement à configurer :

DATABASE_URL="mysql://root:@127.0.0.1:3306/<database name>"
STRIPE_SECRET_KEY="votre_cle_secrete_stripe"
STRIPE_PUBLIC_KEY="votre_cle_public_stripe"

## 6. Utilisation

• Accédez à l'interface : http://localhost:8000.
• Pour ajouter un article au panier, utilisez :
POST /cart/add/{id}
ou aller dans le menu "boutique" visible une fois connecté, cliqué
sur "voir" au niveau d’un article puis sur "ajouter au panier".
• Pour démarrer un paiement Stripe :
POST /cart/checkout
ou
Ajouter un article au panier et une fois sur la page "panier"
appuyer sur le bouton "Finaliser ma commande".

## 7. Structure du projet

• src/Controller/: Gestion des actions.
• src/Entity/: Gestion des tables dans la base de donnée
• src/Service/: Services comme StripeService.
• templates/: Templates HTML avec Twig.
9. Fonctionnalités principales
• Boutique d’articles
• Ajout au panier
• Paiement sécurisé avec Stripe

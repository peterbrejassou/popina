#!/bin/bash

# Mise à jour des dépendances Symfony avec Composer
composer update

# Mise à jour des dépendances Node avec npm
npm install

# Création de la BD
php bin/console d:d:c
php bin/console d:s:u --force

# Chargement des données de test (data fixtures)
php bin/console d:f:l

# Ouverture de l'application
php bin/console s:r
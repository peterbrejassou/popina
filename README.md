# Popina

Popina est une application web permettant de consulter la liste des restaurants autour de nous. Développée en Symfony par Lola Gauchet et Peter Brejassou.

## Installation

Cloner le dépôt et se placer dans le répertoire du projet:

```git
git clone https://github.com/peterbrejassou/popina
cd popina
```

### Installation automatique

Exécuter le script de configuration :

```bash
bash script-popina.sh
```

### Installation manuelle

Mise à jour des dépendances Symfony avec Composer
```php
composer update
```

Mise à jour des dépendances Node avec npm
```php
npm install
```

Création de la BD
```php
php bin/console d:d:c
php bin/console d:s:u --force
```

Chargement des données de test (data fixtures)
```php
php bin/console d:f:l
```

Ouverture de l'application
```php
php bin/console s:r
```


## Utilisation
Rendez-vous sur http://127.0.0.0:8000 pour accéder à l'application.
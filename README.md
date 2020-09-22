# FilterProduct - Symfony 4

Création d' un système de filtre produit sur Symfony 4

L'objectif est de permettre à l'utilisateur de sélectionner les produits en fonction des différentes catégories, 
d'un prix minimum et maximum et de pouvoir organiser les produits par prix ou par promotion.

Installation
1. Clonez le dépôt : https://github.com/olpok/Filterproduct.git
2. Installer les dépendances : composer install
3. Créer la base de données : bin/console doctrine:database:create
4. Lancer la base de données : bin/console doctrine:schema:update –force
5. Lancez le serveur interne :  php -S 127.0.0.1:8000 -t public
6. L'application est prête à être utilisée !

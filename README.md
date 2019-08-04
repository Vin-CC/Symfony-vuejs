# Symfony-vuejs
Application réalisée dans le cadre d'un test technique

## Contenu
* [**Ennoncé**](#ennoncé)
* [**Installation**](#installation)
* [**Utilisation**](#utilisation)
  * [**API**](#api)
  * [**Application**](#application)
  * [**Format d'un article**](#format-dun-article)
* [**Notes**](#notes)
  * [**Concernant la sécurité**](#concernant-la-sécurité)
  * [**Amélioration d'UX**](#amélioration-dux)

## Ennoncé
A partir de Symfony, tu devras créer un mini site listant des articles.

un article est composé a minima de: 
- un titre 
- une description 
- un auteur 
- une date de modification

L'application devra comporter les routes suivantes: 
- ajout d'un article 
- affichage de l'article 
- mise à jour de l'article 
- liste de tous les articles de manière paginée.

Le passage d'une page à l'autre devra être dynamique. 
Aucune sécurité spécifique n'est demandée.

Techno à utiliser : Symfony, VueJs 
Un plus serait d'utiliser docker.

En terme de design, il n'y a aucune contrainte, il faut juste que ce soit simple à lire et minimaliste

## Installation
Vous pouvez si vous le souhaitez, modifier le .env (situé dans apps/symfony-app) et notamment cette ligne (en sachant que ce sont les mêmes informations que dans la partie 'db' dans le docker-compose.yml):
```
 DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
```
- db_user = user de la bdd
- db_password = mot de passe de l'utilisateur
- db_name = le nom de la bdd

Puis lancer :
```
 docker-compose build 
```
Cette commande va construire les containers demandés dans “docker-compose.yml”.

Une fois l'application construite. Vous pouvez lancer:
```
 docker-compose up -d
```
Pour arrêter les containers utilisez:
```
 docker-compose stop
```
Maintenant vous pouvez lancer les commandes Symfony pour construire l'application sur les containers Docker :
```
 docker-compose exec php composer install 
 docker-compose exec php php bin/console doctrine:schema:create
 docker-compose exec php php bin/console doctrine:fixtures:load
 docker-compose exec php php bin/console assets:install –symlink public/
```
L'application est maintenant en marche et disponible sur : [http://localhost/](http://localhost/)

## Utilisation
### API
Routes:
- GET: /api/articles => lister les articles
- POST: /api/articles => ajouter un article
- GET: /api/articles/:id => afficher un article
- POST: /api/articles/:id => modifier un article

### Application
- /home => liste des articles
- /article/:id => afficher/modifier un article
- /article/add => ajouter un article

### Format d'un article
{
  "id": 1,
  "title": "un titre",
  "description": "une description",
  "autor": "un auteur",
  "modification": "YYYY-MM-DD"
}

## Notes
Quelques améliorations peuvent être faites:

### Concernant la sécurité
Dans l'énoncé il était indiqué qu'aucune sécurité spécifique cependant ces points peuvent être ajoutés:
- Utiliser une autentifiaction Stateless si on fait le choix d'une API REST qui est elle aussi stateless. Une option est d'utiliser JWT
- Ajouter un rate limiting et ajouter les informations dans le header
- Cacher certaines informations dans le header (tel que x-powered-by)

### Amélioration d'UX
J'ai voulu utiliser des composants pour donner des retours à l'utilisateur sur ce qui se passait lors des enregistrements (échecs/réussites)
mais j'ai bloqué dessus pour réussir à les faire fonctionner conjointement des évènements de Vuex donc j'ai préféré mettre cette partie de côté pour ne pas perdre trop de temps

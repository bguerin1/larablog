## Descriptif du projet "Larablog"

Le projet "Larablog" est une synthèse de toutes les connaissances acquises sur le framework Laravel durant la 2nde année du BTS SIO. Il consiste en la création d'un site type blog
avec une gestion d'articles et de commentaires.

## Liste des fonctionnalités du 'larablog'

- [Filtre] -> Filtrage des articles par catégories grâce à un select multiple (1 ou plusieurs catégories peuvent être sélectionnées)
- [Search] -> Fonctionnalité de recherche d'articles par saisie utilisateur. 
- [Create] -> Fonctionnalité de création d'un article
- [Edit] -> Modification d'un article
- [Remove] -> Suppression d'un article
- [Like] -> Fonctionnalité de like d'un article
- [CommentsStore] -> Création de commentaires sur un article 
- [CommentsRemove] -> Possibilité de suppression des commentaires sur un article lorsque l'on est auteur de l'article. 
- [ListArticles] -> Affichage des articles (Les plus likés / les articles d'un utilisateur précis)
- [DetailsArticles] -> Affichage des détails d'un article (titre, contenu, date de publication) et des commentaires en lien avec celui-ci

## Pages du site ou Vues Laravel 

- [Home] -> Affichage de tous les articles filtré par le nombre de like (ordre décroissant)
- [Dashboard] -> Première page une fois connecté, affichage de tous les articles de l'utilisateur connecté et possibilité de paginer, de modifier ou de supprimer un article. 
- [Create] -> Page de création d'un article 
- [Edit] -> Page de modification d'un article
- [Index] -> Affichage de tous les articles d'un utilisateur (Exemple : tous les articles de Bryan Guerin mais possibilité de pouvoir consulter les articles d'un autre utilisateur juste en changeant l'id dans l'url, je considère cette partie comme étant publique et celle-ci est accessible par le lien "Voir mon blog" dans le menu de navigation une fois connecté)
- [Show] -> Affichage des détails d'un articles (titre, contenu, date de publication) et des commentaires de celui-ci, possibilité de commenter directement depuis cette page. 

## Composants Breeze

- [Search-Bar] -> Composants de recherche d'un articles
- [Articles] -> Volonté de créer des composants pour chaque input des forms en liens avec les articles (Exemple : Composants pour le titre d'un article car il se répète plusieurs fois) mais manque de temps 

## Layouts 

- [App] -> Layouts utilisé pour les utilisateurs connectés
- [Articles] -> Layouts utilisé principalement pour la partie publique
- [Guest] -> Layout utilisé principalement pour les pages déjà préfaites par Breeze
- [Navigation] -> Layout utilisé pour les barres de navigations 

## Rôle des controllers

- [UserController] -> Controller utilisé pour toutes les fonctionnalités liés aux utilisateurs (création d'articles, modification, suppression)
- [PublicController] -> Controller utilisé pour toutes les fonctionnalités liés à la partie publique du site. 
- [CommentController] -> Controller utilisé pour toutes les fonctionnalités liés aux commentaires; 

### Outils utilisés 

Utilisation des outils suivants : 

- [Laravel](avec PHP 8.3 - Structure MVC - Moteur de template Blade - Breeze - ORM Eloquent)
- [Tailwind](avec outils web tels que Flowbite, Preline)
- [Git/Github](outil de versionning)


## License

Edited By @BryanGuerin.

# larablog
